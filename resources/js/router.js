import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component: require('./components/pages/Dashboard.vue').default },
    { path: '/profile', component: require('./components/pages/Profile.vue').default },
    { path: '/users', component: require('./components/pages/Users.vue').default },
    { path: '*', component: require('./components/pages/NotFound.vue').default }

    // { path: '/developer', component: require('./components/pages/Developer.vue').default },

    // { path: '/profile', component: require('./components/Profile.vue') },
    // { path: '*', component: require('./components/NotFound.vue') }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})


export default router
