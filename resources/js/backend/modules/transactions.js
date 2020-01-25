/*
|-------------------------------------------------------------------------------
| VUEX modules/transactions.js
|-------------------------------------------------------------------------------
| The Vuex data store for the transactions
*/

import TransactionApi from '../api/transaction';

export const transactions = {
    /*
      Defines the state being monitored for the module.
    */
    state: {
        transactions: {},
        transactionsLoadStatus: 0,

        transaction: {},
        transactionLoadStatus: 0,

        transactionEdit: {},
        transactionEditLoadStatus: 0,
        transactionEditStatus: 0,
        transactionEditText: '',

    },

    /*
      Defines the actions used to retrieve the data.
    */
    actions: {
        /*
          Loads the transactions from the API
        */
        loadTransactions( { commit, rootState } ){
            commit( 'setTransactionsLoadStatus', 1 );

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

            TransactionApi.getTransactions(params)
                .then( function( response ){
                    commit( 'setTransactions', response.data );
                    commit( 'setTransactionsLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setTransactions', [] );
                    commit( 'setTransactionsLoadStatus', 3 );
                });
        },

        downloadTransactions({commit, rootState}) {
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

            TransactionApi.downloadTransactions(filterString);
        },

        /*
          Loads an individual transaction from the API
        */
        loadTransaction( { commit }, data ){
            commit( 'setTransactionLoadStatus', 1 );

            TransactionApi.getTransaction( data.slug )
                .then( function( response ){
                    commit( 'setTransaction', response.data.data );
                    commit( 'setTransactionLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setTransaction', {} );
                    commit( 'setTransactionLoadStatus', 3 );
                });
        },

    },

    /*
      Defines the mutations used
    */
    mutations: {
        /*
          Sets the transactions load status
        */
        setTransactionsLoadStatus( state, status ){
            state.transactionsLoadStatus = status;
        },

        /*
          Sets the transactions
        */
        setTransactions( state, transactions ){
            state.transactions = transactions;
        },

        /*
          Set the transaction load status
        */
        setTransactionLoadStatus( state, status ){
            state.transactionLoadStatus = status;
        },

        /*
          Set the transaction
        */
        setTransaction( state, transaction ){
            state.transaction = transaction;
        },

    },

    /*
      Defines the getters used by the module
    */
    getters: {
        /*
          Returns the transactions load status.
        */
        getTransactionsLoadStatus( state ){
            return state.transactionsLoadStatus;
        },

        /*
          Returns the transactions.
        */
        getTransactions( state ){
            return state.transactions;
        },

        /*
          Returns the transactions load status
        */
        getTransactionLoadStatus( state ){
            return state.transactionLoadStatus;
        },

        /*
          Returns the transaction
        */
        getTransaction( state ){
            return state.transaction;
        },
    }
};
