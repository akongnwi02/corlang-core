/*
|-------------------------------------------------------------------------------
| VUEX modules/payments.js
|-------------------------------------------------------------------------------
| The Vuex data store for the payments
*/

import PaymentApi from '../api/payment';

export const payments = {
    /*
      Defines the state being monitored for the module.
    */
    state: {
        payments: {},
        paymentsLoadStatus: 0,

        payment: {},
        paymentLoadStatus: 0,

        paymentEdit: {},
        paymentEditLoadStatus: 0,
        paymentEditStatus: 0,
        paymentEditText: '',

    },

    /*
      Defines the actions used to retrieve the data.
    */
    actions: {
        /*
          Loads the payments from the API
        */
        loadPayments( { commit, rootState } ){
            commit( 'setPaymentsLoadStatus', 1 );

            let params = {};

            if (rootState.filters.pageNumber) {
                params.page = rootState.filters.pageNumber
            }

            if (rootState.filters.landlordFilter) {
                params.landlord_name = rootState.filters.landlordFilter
            }

            if (rootState.filters.userFilter) {
                params.username = rootState.filters.userFilter
            }

            if (rootState.filters.startDateFilter) {
                params.start_date = rootState.filters.startDateFilter
            }

            if (rootState.filters.endDateFilter) {
                params.end_date = rootState.filters.endDateFilter
            }

            PaymentApi.getPayments(params)
                .then( function( response ){
                    commit( 'setPayments', response.data );
                    commit( 'setPaymentsLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setPayments', [] );
                    commit( 'setPaymentsLoadStatus', 3 );
                });
        },

        downloadPayments({commit, rootState}) {
            let filterString = '';

            if (rootState.filters.landlordFilter !== '') {
                filterString += 'landlord_name=' + rootState.filters.landlordFilter
            }

            if (rootState.filters.userFilter !== '') {
                filterString += '&username=' + rootState.filters.userFilter
            }

            if (rootState.filters.startDateFilter !== '') {
                filterString += '&start_date=' + rootState.filters.startDateFilter
            }

            if (rootState.filters.endDateFilter !== '') {
                filterString += '&end_date=' + rootState.filters.endDateFilter
            }

            PaymentApi.downloadPayments(filterString);
        },

        /*
          Loads an individual payment from the API
        */
        loadPayment( { commit }, data ){
            commit( 'setPaymentLoadStatus', 1 );

            PaymentApi.getPayment( data.slug )
                .then( function( response ){
                    commit( 'setPayment', response.data.data );
                    commit( 'setPaymentLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setPayment', {} );
                    commit( 'setPaymentLoadStatus', 3 );
                });
        },

    },

    /*
      Defines the mutations used
    */
    mutations: {
        /*
          Sets the payments load status
        */
        setPaymentsLoadStatus( state, status ){
            state.paymentsLoadStatus = status;
        },

        /*
          Sets the payments
        */
        setPayments( state, payments ){
            state.payments = payments;
        },

        /*
          Set the payment load status
        */
        setPaymentLoadStatus( state, status ){
            state.paymentLoadStatus = status;
        },

        /*
          Set the payment
        */
        setPayment( state, payment ){
            state.payment = payment;
        },

    },

    /*
      Defines the getters used by the module
    */
    getters: {
        /*
          Returns the payments load status.
        */
        getPaymentsLoadStatus( state ){
            return state.paymentsLoadStatus;
        },

        /*
          Returns the payments.
        */
        getPayments( state ){
            return state.payments;
        },

        /*
          Returns the payments load status
        */
        getPaymentLoadStatus( state ){
            return state.paymentLoadStatus;
        },

        /*
          Returns the payment
        */
        getPayment( state ){
            return state.payment;
        },
    }
};
