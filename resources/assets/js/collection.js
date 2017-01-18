require('./app');

var collection = new Vue({
    el: '#app',
    data: {
        games: []
    },
    ready: function () {
        var self = this;
        $.ajax({
            url: '/api/user/me/collection'
        });
    }
});
