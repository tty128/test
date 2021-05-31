const router = new VueRouter({
    routes: [
        { path: '/', component: httpVueLoader('./page.vue') },
        { path: '/page1', component: httpVueLoader('./page.vue') },
        { path: '/page2', component: httpVueLoader('./page2.vue') },
        {
            path: '/user',
            component: httpVueLoader('./user/user.vue'),
            children: [
                { path: '', component: httpVueLoader('./user/profile.vue') },
            ]
        },
        {
            path: '/post',
            component: httpVueLoader('./post/post.vue'),
            children: [
                { path: '', component: httpVueLoader('./post/read.vue') },
                { path: 'create', component: httpVueLoader('./post/create.vue') },
                { path: 'update', component: httpVueLoader('./post/update.vue') },
            ]
        },
        {
            path: '/category/:id',
            component: httpVueLoader('./category/category.vue'),
            children: [
                { path: '', component: httpVueLoader('./category/read.vue') },
                { path: 'create', component: httpVueLoader('./category/create.vue') },
                { path: 'update', component: httpVueLoader('./category/delete.vue') },
            ]
        },
        {
            path: '/tag/:id',
            component: httpVueLoader('./tag/tag.vue'),
            children: [
                {path: '', component: httpVueLoader('./tag/read.vue')},
                { path: 'create', component: httpVueLoader('./tag/create.vue') },
                { path: 'update', component: httpVueLoader('./tag/delete.vue') },
            ]
        },
    ]
})

Vue.component('vue-menu', httpVueLoader('./header-parts/menu.vue'));
Vue.component('vue-aside', httpVueLoader('./aside.vue'));
Vue.component('vue-nav', httpVueLoader('./nav.vue'));
Vue.component('laravel-header', httpVueLoader('./laravel/header.vue'));
Vue.component('vue-pagination', httpVueLoader('./Pagination.vue'));
Vue.component('vue-element-card', httpVueLoader('./ElementCard.vue'));
Vue.component('vue-element-modal', httpVueLoader('./ElementModal.vue'));

const app = new Vue({
    el: "#app",
    router,
    components: {
        'vue-header': httpVueLoader('./header.vue'),
        //'vue-menu': httpVueLoader('./header-parts/menu.vue'),
    }
});