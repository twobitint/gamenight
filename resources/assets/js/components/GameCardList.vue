<template>
    <div class="boardgame-list">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <tr v-for="game in games"
                    is="game-card"
                    :data="game"
                ></tr>
                <infinite-loading :on-infinite="onInfinite" ref="infiniteLoading">
                  <span slot="no-more">
                    There is no more Hacker News :(
                  </span>
                </infinite-loading>
            </div>
        </div>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        props: ['source'],
        data: function () {
            return {
                games: [],
                perPage: 1
            };
        },
        // mounted() {
        //     this.$http.get(this.source)
        //         .then(response => {
        //             this.games = response.data;
        //         });
        // },
        methods: {
            onInfinite() {
                this.$http.get(this.source, {
                    params: {
                        page: this.games.length / this.perPage + 1,
                    },
                }).then(res => {
                    if (res.data.data.length) {
                        this.perPage = res.data.per_page;
                        this.games = this.games.concat(res.data.data);
                        this.$refs.infiniteLoading.$emit('$InfiniteLoading:loaded');
                        if (res.data.current_page == res.data.last_page) {
                            this.$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
                        }
                    } else {
                        this.$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
                    }
                });
            },
        },
        components: {
            InfiniteLoading,
        },
    }
</script>
