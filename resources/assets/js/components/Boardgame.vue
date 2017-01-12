<template>
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card card-boardgame">
                <div class="card-header" v-bind:style="{
                    backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(' + data.image + ')',
                    width: '100%',
                    height: '200px',
                    backgroundSize: 'cover',
                    backgroundPosition: 'center center',
                    color: 'white',
                    fontSize: '22pt',
                    position: 'relative'
                    /*backgroundBlendMode: 'multiply',
                    backgroundColor: 'rgb(95, 165, 255)'*/
                }">
                    <div class="row">
                        <div class="col">
                            <small>{{ weight }}</small>
                        </div>
                        <div class="col" style="text-align: right;">
                            <small>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                {{ parseFloat(Math.round(data.rating_bayes * 100) / 100).toFixed(2) }}
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3>{{ data.name }}</h3>
                        </div>
                    </div>
                </div>
                <!-- <img :src="image" style="width: auto; height: 100px; min-width: 100%;"> -->
                <div class="card-block">
                    <!-- <img :src="thumbnail" class="img-responsive pull-left" alt="thumbnail"> -->
                    <!-- {{ description }} -->
                    <!-- <ul>
                        <li v-for="tag in data.tags">
                            {{ tag.type }} {{ tag.name }}
                        </li>
                    </ul> -->
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
