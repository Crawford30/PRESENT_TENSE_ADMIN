import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component: require('./components/pages/Dashboard.vue').default },
    { path: '/profile', component: require('./components/pages/Profile.vue').default },
    { path: '/users', component: require('./components/pages/ManageUser.vue').default },
    //{ path: '/users', component: require('./components/pages/Users.vue').default },
    // { path: '*', component: require('./components/pages/NotFound.vue').default },

    { path: '/audio-dvds', component: require('./components/pages/DVDS/AudioDVDS.vue').default },
    { path: '/video-dvds', component: require('./components/pages/DVDS/VideoDVDS.vue').default },

    { path: '/present-tense-songs', component: require('./components/pages/SONGS/ThePresentTenseSongs.vue').default },
    { path: '/ten-major-songs', component: require('./components/pages/SONGS/GodTenMajorSongs.vue').default },
    { path: '/praises-and-worship-songs', component: require('./components/pages/SONGS/PraisesAndWorshipSongs.vue').default },
    { path: '/big-songbook-songs', component: require('./components/pages/SONGS/TheBigSongBookSongs.vue').default },
    { path: '/in-various-tongues-songs', component: require('./components/pages/SONGS/SongInVariousTongues.vue').default },


    // { path: '/developer', component: require('./components/pages/Developer.vue').default },

    // { path: '/profile', component: require('./components/Profile.vue') },
    // { path: '*', component: require('./components/NotFound.vue') }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})


export default router
