/*
  Imports the routes and store and vue to use with the Vue module.
*/
import Vue from 'vue';
import router from './routes.js';
import store from './store.js';
import i18n from './i18n';


import "@fortawesome/fontawesome-free/css/all.min.css";

import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import 'bootstrap-css-only/css/bootstrap.min.css'
import 'mdbvue/lib/css/mdb.min.css'

Vue.use(Buefy);

/*
   Register the main component
 */
Vue.component('layout', require('./layouts/Layout'));

/*
  Create a new Vue instance and mount the app element.
*/
new Vue({
    router,
    store,
    i18n,
}).$mount('#app');

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
