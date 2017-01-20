<template>
    <div class="game-collection">
        <form class="form-inline my-sm-3">
            <label class="mr-sm-2">Filter List</label>
            <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" v-model="filter" placeholder="Type...">
        </form>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th v-on:click="sortBy('name')">Name</th>
                    <th v-on:click="sortBy('rating_bayes')">Rating</th>
                    <th v-on:click="sortBy('weight_average')">Weight</th>
                    <th>Categories</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="game in sortedGames"
                    is="game-row"
                    :data="game"
                ></tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['source'],
        data: function () {
            return {
                games: [],
                sortType: 'name',
                sortOrder: 'asc',
                filter: ''
            };
        },
        computed: {
            sortedGames: function () {
                var filter = this.filter.toLowerCase();
                var filtered = _.filter(this.games, f => {
                    var tags = _.reduce(f.tags, (result, r) => {
                        return result + (r.type == 'boardgamecategory' ? r.name + ' ' : '');
                    }, '');
                    return (f.name + tags).toLowerCase().includes(filter);
                });
                return _.orderBy(filtered, this.sortType, this.sortOrder);
            }
        },
        methods: {
            sortBy: function (type) {
                if (this.sortType == type) {
                    this.sortOrder = this.sortOrder == 'asc' ? 'desc' : 'asc';
                }
                this.sortType = type;
            }
        },
        mounted() {
            this.$http.get(this.source)
                .then(response => {
                    this.games = response.data;
                });
        }
    }
</script>
