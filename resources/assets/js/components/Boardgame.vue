<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-boardgame">
                    <div class="panel-heading">{{ name }}</div>

                    <div class="panel-body">
                        <img :src="thumbnail" class="img-responsive pull-left" alt="thumbnail">
                        {{ description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'description', 'thumbnail'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
