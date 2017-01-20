<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Carbon\Carbon;

use App\Boardgame;
use App\Tag;
use App\Rank;
use App\BoardgamePlayerCount;

class BGGController extends Controller
{
    protected static $lastBGGRequest = 0;

    public static function updateGame($bgg_thing)
    {
        $thing = $bgg_thing;
        // We only want boardgames and expansions
        $type = $thing['type'];
        if ($type != 'boardgame' && $type != 'boardgameexpansion') {
            return null;
        }

        $name = is_array($thing->name) ? $thing->name[0]['value'] : $thing->name['value'];
        $rank = is_array($thing->statistics->ratings->ranks->rank) ?
            array_filter($thing->statistics->ratings->ranks->rank, function ($e) {
                return $e['name'] == 'boardgame';
            })[0]->value :
            $thing->statistics->ratings->ranks->rank['value'];

        if ($rank == 'Not Ranked') {
            $rank = null;
        }

        // decode html entities to utf8 characters
        $description = preg_replace_callback("/(&#[0-9]+;)/", function ($m) {
            return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
        }, html_entity_decode($thing->description));

        $game = Boardgame::updateOrCreate(
            ['id' => $thing['id']],
            [
                'name' => $name,
                'rank' => $rank,
                'type' => $type,
                'thumbnail' => $thing->thumbnail,
                'image' => $thing->image,
                'description' => $description,
                'year' => $thing->yearpublished['value'],
                'min_players' => $thing->minplayers['value'],
                'max_players' => $thing->maxplayers['value'],
                'playtime' => $thing->playingtime['value'],
                'min_playtime' => $thing->minplaytime['value'],
                'max_playtime' => $thing->maxplaytime['value'],
                'users_rated' => $thing->statistics->ratings->usersrated['value'],
                'rating_average' => $thing->statistics->ratings->average['value'],
                'rating_bayes' => $thing->statistics->ratings->bayesaverage['value'],
                'stddev' => $thing->statistics->ratings->stddev['value'],
                'weight_count' => $thing->statistics->ratings->numweights['value'],
                'weight_average' => $thing->statistics->ratings->averageweight['value'],
                // The hot node is being added by the update command, not part of normal BGG dataset
                'hot_at' => (string)$thing->hot['value'] ? Carbon::now() : null
            ]
        );

        // Laravel really wants to set the id property to be 0 on Create, so change it manually
        $game->id = $thing['id'];
        return $game;
    }

    public static function updateTags($bgg_thing, $game)
    {
        $tag_ids = [];
        foreach ($bgg_thing->link as $link) {
            $tag = Tag::updateOrCreate(
                ['type' => $link['type'], 'bgg_id' => $link['id']],
                ['name' => $link['value']]
            );
            $tag_ids[] = $tag->id;
        }
        $game->tags()->sync($tag_ids);
    }

    public static function updateRanks($bgg_thing, $game)
    {
        foreach ($bgg_thing->statistics->ratings->ranks->rank as $rank) {
            if ($rank['value'] != 'Not Ranked') {
                $rank = Rank::updateOrCreate(
                    [
                        'type' => $rank['type'],
                        'name' => $rank['name'],
                        'boardgame_id' => $game->id
                    ],
                    [
                        'bgg_id' => $rank['id'],
                        'pretty_name' => $rank['friendlyname'],
                        'rank' => $rank['value'],
                        'bayes_average' => $rank['bayesaverage']
                    ]
                );
            }
        }
    }

    public static function updatePlayerCounts($bgg_thing, $game)
    {
        $players = array_filter($bgg_thing->xpath('//poll'), function ($e) {
            return $e['name'] == 'suggested_numplayers';
        })[0]->results;

        foreach ($players as $player) {
            $matches = [];
            $or_more_reg = preg_match('/([\d]+)\+/', $player['numplayers'], $matches);
            $number = $or_more_reg ? $matches[1] : $player['numplayers'];
            $or_more = $or_more_reg ? true : false;
            $best = intval($player->result[0]['numvotes']);
            $recommended = intval($player->result[1]['numvotes']);
            $bad = intval($player->result[2]['numvotes']);
            $total = $best + $recommended + $bad;
            $playerCount = BoardgamePlayerCount::updateOrCreate(
                ['boardgame_id' => $game->id, 'players' => $number, 'or_more' => $or_more],
                [
                    'best' => $total == 0 ? 0 : ($best / $total),
                    'recommended' => $total == 0 ? 0 : ($recommended / $total),
                    'bad' => $total == 0 ? 0 : ($bad / $total),
                    'optimal' => $total == 0 ? 0 : ($best / $total + $recommended / $total),
                    'weighted' => $total
                ]
            );
        }
    }

    public static function bggRequest($uri, $options)
    {
        $wait = 0.5; // 0.5 seconds
        $waited = microtime(true) - self::$lastBGGRequest;
        if ($waited < $wait) {
            usleep(($wait - $waited) * 1000000);
        }

        $client = new Client([
            'base_uri' => 'https://www.boardgamegeek.com/xmlapi2/'
        ]);
        $response = $client->get($uri, $options);

        $xml = new \SimpleXMLElement($response->getBody());

        self::$lastBGGRequest = microtime(true);

        return $xml;
    }
}
