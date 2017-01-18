<template>
    <div class="card card-boardgame">
        <div class="card-header" v-bind:style="{
            backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(' + data.image + ')',
        }">
            <div class="row">
                <div class="col">
                    {{ weight }}
                </div>
                <div class="col" style="text-align: right;">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    {{ parseFloat(Math.round(data.rating_bayes * 100) / 100).toFixed(2) }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h3 class="mb-0">
                        <a :href="'https://boardgamegeek.com/boardgame/'+data.id">{{ data.name }}</a>
                    </h3>
                    <ul class="list-inline boardgame-categories">
                        <li v-for="rank in data.ranks"
                            v-if="rank.type == 'family'"
                            style="display: inline-block">
                            <small>{{ rank.name }}</small>
                        </li>
                        <li v-for="tag in data.tags"
                            v-if="tag.type == 'boardgamecategory'"
                            style="display: inline-block;">
                            <small>{{ tag.name }}</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <img :src="image" style="width: auto; height: 100px; min-width: 100%;"> -->
        <div class="card-block">
            <!-- <img :src="thumbnail" class="img-responsive pull-left" alt="thumbnail"> -->
            <!-- {{ description }} -->
            <div class="row row-no-gutter">
                <div class="col">
                    <div class="data">
                        <div class="text">Wishlisted</div>
                        <div class="value">
                            <i class="fa fa-heart-o" aria-hidden="true" style="font-size: 20pt;"></i>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="data">
                        <div class="text">Rated</div>
                        <div class="value">
                            <i class="fa fa-thumbs-o-up" aria-hidden="true" style="font-size: 20pt;"></i>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="data">
                        <div class="text">Owned</div>
                        <div class="value">
                            <i class="fa fa-check" aria-hidden="true" style="font-size: 20pt;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        computed: {
            weight: function () {
                var weights = ['Very Light', 'Light', 'Medium', 'Heavy', 'Very Heavy'];
                return weights[Math.floor(this.data.weight_average)];
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
