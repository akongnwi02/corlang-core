/*
|-------------------------------------------------------------------------------
| routes.js
|-------------------------------------------------------------------------------
| Contains all of the routes for the application
*/

/*
	Imports Vue and VueRouter to extend with the routes.
*/
import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './store.js';

/*
	Extends Vue to use Vue Router
*/
Vue.use( VueRouter );

/*
	Makes a new VueRouter that we will use to run all of the routes
	for the app.
*/
export default new VueRouter({
    routes: [
        {
            path: '/electricity/search',
            name: 'electricity.search',
            component: Vue.component( 'Search', require( './components/electricity/Search' ) ),
        },
    ]
});
