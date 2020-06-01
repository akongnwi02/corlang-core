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
            path: '/prepaid/bill/search',
            name: 'prepaid.bill.search',
            component: Vue.component('Search', require('./components/prepaid-bill/Search')),
        },
        {
            path: '/postpaid/bill/search',
            name: 'postpaid.bill.search',
            component: Vue.component('PostpaidBillSearch', require('./components/postpaid-bills/PostpaidBillSearch')),
        },
        {
            path: '/momo',
            name: 'momo',
            component: Vue.component('MomoSearch', require('./components/mobile-money/Search')),
        },
        {
            path: '/airtime',
            name: 'airtime',
            component: Vue.component('AirtimeSearch', require('./components/airtime/AirtimeSearch')),
        },
        // {
        //     path: '/transaction/view/:uuid',
        //     name: 'transaction.view',
        //     component: Vue.component( 'Transaction', require( './components/global/Transaction' ) ),
        // },
    ]
});
