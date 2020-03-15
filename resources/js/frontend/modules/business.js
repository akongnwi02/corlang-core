/*
|-------------------------------------------------------------------------------
| VUEX modules/quote.js
|-------------------------------------------------------------------------------
| The Vuex data store for the quote
*/

import BusinessApi from '../api/business';
import { helper} from '../helpers/helpers';
import {BUSINESS_CONFIG} from "../config/business";

export const business = {
    state: {
        quote: {},
        quoteLoadStatus: 0,

        payment: {},
        paymentStatus: 0,

        configurationLoadStatus: 0,
        configuration: {},
    },

    actions: {
        loadQuote( { commit }, data ){
            commit( 'setQuoteLoadStatus', 1 );

            BusinessApi.quote(data)
                .then( function( response ){
                    commit( 'setQuote', response.data );
                    commit( 'setQuoteLoadStatus', 2 );
                })
                .catch( function( error ){
                    commit( 'setQuoteLoadStatus', 3 );
                    helper.handleException(error);
                    commit( 'setQuote', {} );
                });
        },

        performPayment({commit}, data) {
            commit('setPaymentStatus', 1);
            BusinessApi.pay(data)
                .then(function (response) {
                    // Do nothing because request will be processed
                    // asynchronously
                })
                .catch(function (error) {
                    commit( 'setPaymentStatus', 3 );
                    helper.handleException(error);
                    commit( 'setPayment',  {});
                });
        },

        loadConfiguration( { commit } ){

            commit( 'setConfigurationLoadStatus', 1 );

            let configExist = false;

            // load the config from cache
            if (localStorage.getItem('configuration')) {
                let configuration = JSON.parse(localStorage.getItem('configuration'));
                if ((new Date()).getTime() > configuration.expiration) {
                    localStorage.removeItem('configuration');
                    configExist = false;
                } else {
                    commit('setConfiguration', configuration);
                    commit('setConfigurationLoadStatus', 2);
                    configExist = true;
                }
            }

            if (! configExist) {
                // load the config from the API
                BusinessApi.configuration()
                    .then( function( response ){
                        let configuration = response.data;
                        configuration.expiration = (new Date()).getTime() + BUSINESS_CONFIG.CACHE_EXPIRATION;
                        localStorage.setItem('configuration', JSON.stringify(configuration));
                        commit( 'setConfiguration', configuration );
                        commit('setConfigurationLoadStatus', 2);
                    })
                    .catch( function(error){
                        commit('setConfigurationLoadStatus', 3);
                        helper.handleException(error);
                        commit('setConfiguration', {});
                    });
            }
        },
    },

    mutations: {
        setQuoteLoadStatus( state, status ){
            state.quoteLoadStatus = status;
        },
        setQuote( state, quote ){
            state.quote = quote;
        },
        setPaymentStatus(state, status) {
            state.paymentStatus = status;
        },
        setPayment(state, payment) {
            state.payment = payment
        },
        setConfigurationLoadStatus( state, status ){
            state.configurationLoadStatus = status;
        },
        setConfiguration( state, configuration ){
            state.configuration = configuration;
        },
    },

    getters: {
        getQuoteLoadStatus( state ){
            return state.quoteLoadStatus;
        },
        getPaymentStatus( state ){
            return state.paymentStatus;
        },
        getQuote( state ){
            return state.quote;
        },
        getPayment(state) {
            return state.payment;
        },
        getConfigurationLoadStatus( state ){
            return state.configurationLoadStatus;
        },

        getConfiguration( state ) {
            return state.configuration;
        }
    }
};
