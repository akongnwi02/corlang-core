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
            path: '/',
            redirect: { name: 'purchase' },
            name: 'layout',
            component: Vue.component( 'Layout', require( './layouts/Layout' ) ),
            children: [
                {
                    path: 'purchase',
                    name: 'purchase',
                    component: Vue.component( 'Purchase', require( './pages/Purchase' ) ),
                    children: [
                        {
                            path: 'electricity',
                            name: 'electricity',
                            component: Vue.component( 'Electricity', require( './components/electricity/Search' ) ),
                            // beforeEnter: requireAuth,
                            // meta: {
                            //     permission: 'user'
                            // }
                        },
                    ]
                },
                {
                    path: 'transactions',
                    name: 'transactions',
                    component: Vue.component( 'Transactions', require( './pages/Transactions' ) ),
                    // beforeEnter: requireAuth,
                    // meta: {
                    //     permission: 'user'
                    // }
                },

                /*
                    Catch Alls
                */
                { path: '_=_', redirect: '/' }
            ]
        },
    ]
});
