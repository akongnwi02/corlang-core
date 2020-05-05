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

        transaction: {},
        transactionLoadStatus: 0,

        configurationLoadStatus: 0,
        configuration: {},

        transactions: [],
        transactionsLoadStatus: 0,

        account:{},
        accountLoadStatus: 0,

        payoutStatus: 0,
        payout: {},

        payoutsLoadStatus: 0,
        payouts: [],

        cancelPayoutStatus: 0,
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
                    commit( 'setQuote', {} );
                    helper.handleException(error);
                });
        },

        confirmPayment({commit}, data) {
            commit('setPaymentStatus', 1);
            BusinessApi.confirm(data)
                .then(function (response) {
                    commit('setTransaction', response.data)
                })
                .catch(function (error) {
                    commit( 'setPaymentStatus', 3 );
                    commit( 'setPayment',  {});
                    helper.handleException(error);
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
                        commit('setConfiguration', {});
                        helper.handleException(error);
                    });
            }
        },
        loadTransactions( { commit } ) {
            commit('setTransactionsLoadStatus', 1);
            BusinessApi.transactions()
                .then(function (response) {
                    commit('setTransactions', response.data);
                    commit('setTransactionsLoadStatus', 2);
                })
                .catch(function (error) {
                    commit('setTransactionsLoadStatus', 3);
                    commit('setTransactions', []);
                    helper.handleException(error);
                });
        },
        getAccount({commit}) {
            commit('setAccountLoadStatus', 1);
            BusinessApi.account()
                .then(function (response) {
                    commit('setAccountLoadStatus', 2);
                    commit('setAccount', response.data);
                })
                .catch(function (error) {
                    commit('setAccountLoadStatus', 3);
                    commit('setAccount', {});
                    helper.handleException(error);
                })
        },
        requestPayout({commit}, data) {
            commit('setPayoutStatus', 1);
            BusinessApi.payout(data)
                .then(function (response) {
                    commit('setPayoutStatus', 2);
                    commit('setPayout', response.data);
                })
                .catch(function (error) {
                    commit('setPayoutStatus', 3);
                    commit('setPayout', {});
                    helper.handleException(error);
                });
        },
        loadPayouts({commit}) {
            commit('setPayoutsLoadStatus', 1);
            BusinessApi.getPayouts()
                .then(function (response) {
                    commit('setPayoutsLoadStatus', 2);
                    commit('setPayouts', response.data);
                })
                .catch(function (error) {
                    commit('setPayoutsLoadStatus', 3);
                    commit('setPayouts', []);
                    helper.handleException(error);
                });
        },
        cancelPayout({commit}, uuid) {
            commit('setCancelPayoutStatus', 1);
            BusinessApi.cancelPayout(uuid)
                .then(function (response) {
                    commit('setCancelPayoutStatus', 2);

                })
                .catch(function (error) {
                    commit('setCancelPayoutStatus', 3);
                    helper.handleException(error);
                })
        },
        loadTransaction({commit}, uuid) {
            commit('setTransactionLoadStatus', 1);
            BusinessApi.transaction(uuid)
                .then(function (response) {
                    commit('setTransactionLoadStatus', 2);
                    commit('setTransaction', response.data);
                })
                .catch(function (error) {
                    commit('setTransactionLoadStatus', 3);
                    helper.handleException(error);
                })
        }
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
        setTransactions(state, transactions) {
            state.transactions = transactions;
        },
        setTransactionsLoadStatus(state, status) {
            state.transactionsLoadStatus = status;
        },
        setAccountLoadStatus(state, status) {
            state.accountLoadStatus = status;
        },
        setAccount(state, account) {
            state.account = account;
        },
        setPayoutStatus(state, status) {
            state.payoutStatus = status;
        },
        setPayout(state, payout) {
            state.payout = payout;
        },
        setPayoutsLoadStatus(state, status) {
            state.payoutsLoadStatus = status;
        },
        setPayouts(state, payouts) {
            state.payouts = payouts;
        },
        setCancelPayoutStatus(state, status) {
            state.cancelPayoutStatus = status;
        },
        setTransaction(state, transaction) {
            state.transaction = transaction;
        } ,
        setTransactionLoadStatus(state, status) {
            state.transactionLoadStatus = status;
        }
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
        },
        getTransactions(state) {
            return state.transactions;
        },
        getTransactionsLoadStatus(state) {
            return state.transactionsLoadStatus;
        },
        getAccount(state) {
            return state.account;
        },
        getAccountLoadStatus(state) {
            return state.accountLoadStatus
        },
        getPayoutStatus(state) {
            return state.payoutStatus;
        },
        getPayout(state) {
            return state.payout;
        },
        getPayoutsLoadStatus(state) {
            return state.payoutsLoadStatus;
        },
        getPayouts(state) {
            return state.payouts;
        },
        getCancelPayoutStatus(state) {
            return state.cancelPayoutStatus;
        },
        getTransaction(state) {
            return state.transaction;
        },
        getTransactionLoadStatus(state) {
            return state.transactionLoadStatus;
        }
    }
};
