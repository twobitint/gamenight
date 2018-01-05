
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
require('vue-resource');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('event', require('./components/Event.vue'));
Vue.component('game-card', require('./components/GameCard.vue'));
Vue.component('game-row', require('./components/GameRow.vue'));
Vue.component('game-collection', require('./components/GameCollection.vue'));
Vue.component('game-cardlist', require('./components/GameCardList.vue'));

const app = new Vue({
    el: '#app'
});
