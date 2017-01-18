require('./app');

var collection = new Vue({
    el: '#app',
    data: {
        games: []
    },
    ready: function () {
        console.log('hell');
        var self = this;
        this.$http.get('/user')
            .then(response => {
                console.log(response.data);
            });
    }
});
