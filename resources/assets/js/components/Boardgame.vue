<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-boardgame">
                    <div class="panel-heading" v-bind:style="{
                        backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(' + image + ')',
                        width: '100%',
                        height: '200px',
                        backgroundSize: 'cover',
                        backgroundPosition: 'center center',
                        color: 'white',
                        fontSize: '22pt'
                        /*backgroundBlendMode: 'multiply',
                        backgroundColor: 'rgb(95, 165, 255)'*/
                    }">{{ name }}</div>
                    <!-- <img :src="image" style="width: auto; height: 100px; min-width: 100%;"> -->
                    <div class="panel-body">
                        <!-- <img :src="thumbnail" class="img-responsive pull-left" alt="thumbnail"> -->
                        {{ description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'description', 'thumbnail', 'image'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
