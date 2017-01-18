<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-event">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                games: []
            };
        },
        ready: function () {
            //
        },
        mounted() {
            var self = this;
            this.$http.get('/api/user/whumples/collection')
                .then(response => {
                    console.log(response.data);
                });
        }
    }
</script>
