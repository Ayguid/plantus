
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('feed-component', require('./components/FeedComponent.vue'));
Vue.component('post-component', require('./components/PostComponent.vue'));
Vue.component('form-component', require('./components/FormComponent.vue'));
Vue.component('categoriesmenu-component', require('./components/CategoriesMenuComponent.vue'));
Vue.component('userprofile-component', require('./components/UserProfileComponent.vue'));
Vue.component('comments-list-component', require('./components/CommentsListComponent.vue'));
Vue.component('comment-component', require('./components/CommentComponent.vue'));
Vue.component('form-comment-component', require('./components/FormCommentComponent.vue'));

const app = new Vue({
    el: '#app',
});
