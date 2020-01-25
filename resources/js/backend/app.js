import '@coreui/coreui'

/*
  Imports the routes and store and vue to use with the Vue module.
*/
import Vue from 'vue';
import router from './routes.js'
import store from './store.js'
import i18n from './i18n';

/*
    Register the components since we're currently using non SPA
 */
Vue.component('transactions', require('./pages/Transaction'));
Vue.component('landlords', require('./pages/Landlord'));
Vue.component('payments', require('./pages/Payment'));
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('list-filters', require('./components/ListFilters'));

/*
    Register the directives
 */
Vue.directive('can', require('./directives/Permission'));

/*
  Create a new Vue instance and mount the app element.
*/
new Vue({
    router,
    store,
    i18n
}).$mount('#app-body');

// /*
//   Send google analytics the current path.
// */
// ga('set', 'page', router.currentRoute.path);
// ga('send', 'pageview');
//
// /*
//   After each page navigation, send the path to Google analytics.
// */
// router.afterEach((to, from) => {
//     ga('set', 'page', to.path);
//     ga('send', 'pageview');
// });
