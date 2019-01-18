
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


Vue.component('flash-message', require('./components/Flash-message.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
Vue.component('avatar-form', require('./components/AvatarForm.vue').default);
Vue.component('wysiwyg', require('./components/Wysiwyg.vue').default);

Vue.component('thread-view', require('./pages/Thread.vue').default);
Vue.component('new-thread', require('./components/modals/NewThread.vue').default);

Vue.component('login', require('./components/modals/Login.vue').default);
Vue.component('register', require('./components/modals/Register.vue').default);

Vue.component("channel-dropdown", require("./components/ChannelDropdown.vue").default);


Vue.component("update-settings", require("./pages/UpdateSettings.vue").default);

Vue.component("thread-graph", require("./components/ThreadGraph.vue").default);

//Dashboards
Vue.component("dashboard-tile", require("./components/Tile.vue").default);
Vue.component("developer-tile", require("./components/DeveloperTile.vue").default);


const app = new Vue({
    el: '#app'
});
