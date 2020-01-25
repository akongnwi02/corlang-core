/*
|-------------------------------------------------------------------------------
| VUEX modules/filters.js
|-------------------------------------------------------------------------------
| The Vuex data store for the filters state
*/

import FilterApi from '../api/filter';

export const filters = {
    /*
      Defines the state used by the module
    */
    state: {
        filters: [],
        landlordFilter: '',
        textSearch: '',
        statusFilter: '',
        userFilter: '',
        orderBy: 'id',
        orderDirection: 'asc',
        pageNumber: '1',
        displayFilters: false,
        endDateFilter: '',
        startDateFilter: '',
        filtersActive: false,
    },

    /*
      Defines the actions that can be performed on the state.
    */
    actions: {

        loadFilters({commit}, data) {
            FilterApi.getFilters()
                .then(function (response) {
                    commit('setFilters', response.data);
                })
                .catch(function (error) {
                    console.log('error fetching filters', error);
                });
        },
        /*
          Updates the landlord filter.
        */
        updateLandlordFilter( { commit }, data ){
            commit( 'setLandlordFilter', data );
        },

        /*
          Updates the user filter.
        */
        updateStartDateFilter( { commit }, data ){
            commit( 'setStartDateFilter', data );
        },
        /*
          Updates the user filter.
        */
        updateEndDateFilter( { commit }, data ){
            commit( 'setEndDateFilter', data );
        },

        /*
          Updates the user filter.
        */
        updateUserFilter( { commit }, data ){
            commit( 'setUserFilter', data );
        },

        updatePageNumber({commit}, data) {
            commit('setPageNumber', data);
        },

        /*
          Updates the text search filter
        */
        updateSetTextSearch( { commit }, data ){
            commit( 'setTextSearch', data );
        },

        /*
          Updates the active location filter.
        */
        updateActiveLocationFilter( { commit }, data ){
            commit( 'setActiveLocationFilter', data );
        },

        /*
          Updates the only liked filter.
        */
        updateOnlyLiked( { commit }, data ){
            commit( 'setOnlyLiked', data );
        },

        /*
          Updates the brew methods filter.
        */
        updateBrewMethodsFilter( { commit }, data ){
            commit( 'setBrewMethodsFilter', data );
        },

        /*
          Updates the has matcha filter.
        */
        updateHasMatcha( { commit }, data ){
            commit( 'setHasMatcha', data );
        },

        /*
          Updates the has tea filter.
        */
        updateHasTea( { commit }, data ){
            commit( 'setHasTea', data );
        },

        /*
          Updates the has subscription filter.
        */
        updateHasSubscription( { commit }, data ){
            commit( 'setHasSubscription', data );
        },

        /*
          Updates the order by setting and sorts the cafes.
        */
        updateOrderBy( { commit, state, dispatch }, data ){
            commit( 'setOrderBy', data );
            dispatch( 'orderTransactions', { order: state.orderBy, direction: state.orderDirection } );
        },

        /*
          Updates the order direction and sorts the cafes.
        */
        updateOrderDirection( { commit, state, dispatch }, data ){
            commit( 'setOrderDirection', data );
            dispatch( 'orderTransactions', { order: state.orderBy, direction: state.orderDirection } );
        },

        /*
          Resets the filters
        */
        resetFilters( { commit }, data ){
            commit( 'resetFilters' );
        }
    },

    /*
      Defines the mutations used by the state.
    */
    mutations: {

        setFilters(state, filters) {
            state.filters = filters;
        },
        /*
          Sets the landlord filter.
        */
        setLandlordFilter( state, landlord ){
            state.landlordFilter = landlord;
        },

        /*
          Sets the user filter.
        */
        setUserFilter( state, username ){
            state.userFilter = username;
        },
        /*
          Sets the start date filter.
        */

        setStartDateFilter( state, startDate ){
            state.startDateFilter = startDate;
        },

        /*
          Sets the end date filter.
        */
        setEndDateFilter( state, endDate ){
            state.endDateFilter = endDate;
        },

        /*
          Sets the text search filter.
        */
        setTextSearch( state, search ){
            state.textSearch = search;
        },

        setPageNumber(state, pageNumber) {
            state.pageNumber = pageNumber;
        },

        /*
          Sets the active location filter.
        */
        setActiveLocationFilter( state, activeLocationFilter ){
            state.activeLocationFilter = activeLocationFilter;
        },

        /*
          Sets the only liked filter.
        */
        setOnlyLiked( state, onlyLiked ){
            state.onlyLiked = onlyLiked;
        },

        /*
          Sets the brew methods filter.
        */
        setBrewMethodsFilter( state, brewMethods ){
            state.brewMethodsFilter = brewMethods;
        },

        setFiltersStatus(state, status) {
            state.filtersActive = status;
        },

        /*
          Sets the order by filter.
        */
        setOrderBy( state, orderBy ){
            state.orderBy = orderBy;
        },

        /*
          Sets the order direction filter.
        */
        setOrderDirection( state, orderDirection ){
            state.orderDirection = orderDirection;
        },

        /*
          Resets the active filters.
        */
        resetFilters( state ){
            state.landlordFilter = '';
            state.userFilter = '';
            state.textSearch = '';
            state.orderBy = 'name';
            state.orderDirection = 'desc';
            state.pageNumber = 1;
            state.statusFilter = '';
            state.startDateFilter = '';
            state.endDateFilter = '';
            state.filtersActive = false;
        }
    },

    /*
      Defines the getters on the Vuex module.
    */
    getters: {
        getFilters(state) {
            return state.filters;
        },

        /*
          Gets the landlord filter.
        */
        getLandlordFilter( state ){
            return state.landlordFilter;
        },

        /*
          Gets the landlord filter.
        */
        getUserFilter( state ){
            return state.userFilter;
        },

        /*
          Gets the landlord filter.
        */
        getStartDateFilter( state ){
            return state.startDateFilter;
        },

        /*
          Gets the landlord filter.
        */
        getEndDateFilter( state ){
            return state.endDateFilter;
        },

        /*
          Gets the text search filter.
        */
        getTextSearch( state ){
            return state.textSearch;
        },

        getPageNumber(state) {
            return state.pageNumber;
        },

        /*
          Gets the order by filter.
        */
        getOrderBy( state ){
            return state.orderBy;
        },

        /*
          Gets the order direction filter.
        */
        getOrderDirection( state ){
            return state.orderDirection;
        },

        getFiltersStatus(state) {
            return state.filtersActive;
        }


    }
};
