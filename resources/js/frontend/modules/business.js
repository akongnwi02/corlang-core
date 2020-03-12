/*
|-------------------------------------------------------------------------------
| VUEX modules/quote.js
|-------------------------------------------------------------------------------
| The Vuex data store for the quote
*/

import BusinessApi from '../api/business';
import { helper} from '../helpers/helpers';
import i18n from '../i18n';

export const business = {
    /*
      Defines the state being monitored for the module.
    */
    state: {
        quote: {},
        quoteLoadStatus: 0,
        quoteErrorMessage: '',
        quoteErrorFields: [],

        payment: {},
        paymentStatus: 0,
        paymentErrorMessage: '',
        paymentErrorFields: [],
    },

    /*
      Defines the actions used to retrieve the data.
    */
    actions: {
        /*
          Loads the quote from the API
        */
        loadQuote( { commit }, data ){
            commit( 'setQuoteLoadStatus', 1 );

            BusinessApi.quote(data)
                .then( function( response ){
                    commit( 'setQuote', response.data );
                    commit( 'setQuoteLoadStatus', 2 );
                })
                .catch( function( error ){
                    if (error.response.data.code == 401 || error.response.data.code == 419) {
                        window.alert(i18n.t('validations.general.unauthorized'));
                        window.location.replace('/login');
                    }
                    let errorFields = [];
                    if (error.response.data.errors) {
                        errorFields = Object.keys(error.response.data.errors);
                        console.log(errorFields);
                    }
                    commit( 'setQuoteLoadStatus', 3 );
                    commit( 'setQuoteErrorMessage', helper.handleException(error) );
                    commit( 'setQuoteErrorFields',  errorFields);
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
                    if (error.response.data.code == 401 || error.response.data.code == 419) {
                        window.alert(i18n.t('validations.general.unauthorized'));
                        window.location.replace('/login');
                    }
                    let errorFields = [];
                    if (error.response.data.errors) {
                        errorFields = Object.keys(error.response.data.errors);
                        console.log(errorFields);
                    }
                    commit( 'setPaymentStatus', 3 );
                    commit( 'setPaymentErrorMessage', helper.handleException(error) );
                    commit( 'setPaymentErrorFields', errorFields );
                    commit( 'setPayment',  {});
                });
        }
    },

    /*
      Defines the mutations used
    */
    mutations: {
        /*
          Sets the quote load status
        */
        setQuoteLoadStatus( state, status ){
            state.quoteLoadStatus = status;
        },

        /*
          Set the quote
        */
        setQuote( state, quote ){
            state.quote = quote;
        },

        setQuoteErrorMessage( state, quoteErrorMessage ){
            state.quoteErrorMessage = quoteErrorMessage;
        },

        setQuoteErrorFields( state, quoteErrorFields ){
            state.quoteErrorFields = quoteErrorFields;
        },

        setPaymentStatus(state, status) {
            state.paymentStatus = status;
        },
        setPayment(state, payment) {
            state.payment = payment
        },
        setPaymentErrorFields(state, paymentErrorFields) {
            state.paymentErrorFields = paymentErrorFields;
        },
        setPaymentErrorMessage(state, paymentErrorMessage) {
            state.paymentErrorMessage = paymentErrorMessage;
        }

    },

    /*
      Defines the getters used by the module
    */
    getters: {
        /*
          Returns the quote load status
        */
        getQuoteLoadStatus( state ){
            return state.quoteLoadStatus;
        },
        getPaymentStatus( state ){
            return state.paymentStatus;
        },

        /*
          Returns the quote
        */
        getQuote( state ){
            return state.quote;
        },
        getQuoteErrorMessage(state) {
            return state.quoteErrorMessage;
        },
        getQuoteErrorFields(state) {
            return state.quoteErrorFields;
        },
        getPayment(state) {
            return state.payment;
        },
        getPaymentErrorMessage(state) {
            return state.paymentErrorMessage;
        },
        getPaymentErrorFields(state) {
            return state.paymentErrorFields;
        }
    }
};
