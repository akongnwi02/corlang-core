/*
|-------------------------------------------------------------------------------
| VUEX store.js
|-------------------------------------------------------------------------------
| Builds the data store from all of the modules for the Roast app.
*/
/*
  Adds the promise polyfill for IE 11
*/
require('es6-promise').polyfill();

/*
	Imports Vue and Vuex
*/
import Vue from 'vue'
import Vuex from 'vuex'

/*
	Initializes Vuex on Vue.
*/
Vue.use( Vuex );

/*
	Imports all of the modules used in the application to build the data store.
*/
import { transactions } from './modules/transactions';
import { landlords } from './modules/landlords';
import { payments } from "./modules/payments";
import { language } from "./modules/language";
import { filters } from "./modules/filters";

/*
  Exports our data store.
*/
export default new Vuex.Store({
    modules: {
        filters,
        transactions,
        payments,
        landlords,
        // // this language module is not currently being used.
        // // Might be used in t he future
        // language,
    }
});
