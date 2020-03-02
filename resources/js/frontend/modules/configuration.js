/*
|-------------------------------------------------------------------------------
| VUEX modules/configuration.js
|-------------------------------------------------------------------------------
| The Vuex data store for the configuration
*/

import ConfigurationApi from '../api/configuration';
import { BUSINESS_CONFIG } from "../config/business";
import { helper } from "../helpers/helpers";

export const configuration = {
    /*
      Defines the state being monitored for the module.
    */
    state: {
        configurationLoadStatus: 0,
    },

    /*
      Defines the actions used to retrieve the data.
    */
    actions: {
        /*
          Loads the quote from the API
        */

        loadConfiguration( { commit } ){

            commit( 'setConfigurationLoadStatus', 1 );

            // load the default currency
            ConfigurationApi.configuration()
                .then( function( response ){
                    commit( 'setConfiguration', response.data );
                    commit('setConfigurationLoadStatus', 2);
                })
                .catch( function(error){
                    commit('setConfigurationLoadStatus', 3);
                    helper.handleException(error);
                });
        },
    },

    /*
      Defines the mutations used
    */
    mutations: {
        /*
          Sets the quote load status
        */
        setConfigurationLoadStatus( state, status ){
            state.quoteLoadStatus = status;
        },
        setConfiguration( state, configuration ){
            configuration.expiration = (new Date()).getTime() + BUSINESS_CONFIG.CACHE_EXPIRATION;
            localStorage.setItem('configuration', JSON.stringify(configuration));
        },
    },

    /*
      Defines the getters used by the module
    */
    getters: {
        /*
          Returns the quote load status
        */
        getConfigurationLoadStatus( state ){
            return state.configurationLoadStatus;
        },

        getConfiguration( state ) {
            if (! localStorage.getItem('configuration')){
                return false;
            }

            let configuration = JSON.parse(localStorage.getItem('configuration'));

            if ((new Date()).getTime() > configuration.expiration) {
                localStorage.removeItem('configuration');
                return false
            }

            return configuration;
        }

    }
};
