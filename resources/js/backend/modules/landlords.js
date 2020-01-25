/*
|-------------------------------------------------------------------------------
| VUEX modules/landlords.js
|-------------------------------------------------------------------------------
| The Vuex data store for the landlords
*/

import LandlordApi from '../api/landlord';

export const landlords = {
    /*
      Defines the state being monitored for the module.
    */
    state: {
        landlords: [],
        landlordsLoadStatus: 0,

        landlord: {},
        landlordLoadStatus: 0,

        landlordEdit: {},
        landlordEditLoadStatus: 0,
        landlordEditStatus: 0,
        landlordEditText: '',

    },

    /*
      Defines the actions used to retrieve the data.
    */
    actions: {
        /*
          Loads the landlords from the API
        */
        loadLandlords( { commit, rootState, dispatch } ){
            commit( 'setLandlordsLoadStatus', 1 );

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

            LandlordApi.getLandlords(params)
                .then( function( response ){
                    commit( 'setLandlords', response.data );
                    commit( 'setLandlordsLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setLandlords', [] );
                    commit( 'setLandlordsLoadStatus', 3 );
                });
        },

        /*
          Loads an individual landlord from the API
        */
        loadLandlord( { commit }, data ){
            commit( 'setLandlordLoadStatus', 1 );

            LandlordApi.getLandlord( data.slug )
                .then( function( response ){
                    commit( 'setLandlord', response.data.data );
                    commit( 'setLandlordLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setLandlord', {} );
                    commit( 'setLandlordLoadStatus', 3 );
                });
        },

    },

    /*
      Defines the mutations used
    */
    mutations: {
        /*
          Sets the landlords load status
        */
        setLandlordsLoadStatus( state, status ){
            state.landlordsLoadStatus = status;
        },

        /*
          Sets the landlords
        */
        setLandlords( state, landlords ){
            state.landlords = landlords;
        },

        /*
          Set the landlord load status
        */
        setLandlordLoadStatus( state, status ){
            state.landlordLoadStatus = status;
        },

        /*
          Set the landlord
        */
        setLandlord( state, landlord ){
            state.landlord = landlord;
        },

    },

    /*
      Defines the getters used by the module
    */
    getters: {
        /*
          Returns the landlords load status.
        */
        getLandlordsLoadStatus( state ){
            return state.landlordsLoadStatus;
        },

        /*
          Returns the landlords.
        */
        getLandlords( state ){
            return state.landlords;
        },

        /*
          Returns the landlords load status
        */
        getLandlordLoadStatus( state ){
            return state.landlordLoadStatus;
        },

        /*
          Returns the landlord
        */
        getLandlord( state ){
            return state.landlord;
        },
    }
};
