
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('flash-message', require('./components/Flash-message.vue'));
Vue.component('paginator', require('./components/Paginator.vue'));
Vue.component('user-notifications', require('./components/UserNotifications.vue'));
Vue.component('avatar-form', require('./components/AvatarForm.vue'));
Vue.component('wysiwyg', require('./components/Wysiwyg.vue'));

Vue.component('thread-view', require('./pages/Thread.vue'));

Vue.component('login', require('./components/modals/Login.vue'));
Vue.component('register', require('./components/modals/Register.vue'));

Vue.component("channel-dropdown", require("./components/ChannelDropdown.vue"));


Vue.component("update-settings", require("./pages/UpdateSettings.vue"));

//Dashboards
Vue.component("dashboard-tile", require("./components/Tile.vue"));
Vue.component("developer-tile", require("./components/DeveloperTile.vue"));


const app = new Vue({
    el: '#app'
});
