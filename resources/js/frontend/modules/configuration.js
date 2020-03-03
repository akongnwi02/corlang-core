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
        configuration: {},
        selectedService: {}
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
                ConfigurationApi.configuration()
                    .then( function( response ){
                        let configuration = response.data;
                        configuration.expiration = (new Date()).getTime() + BUSINESS_CONFIG.CACHE_EXPIRATION;
                        localStorage.setItem('configuration', JSON.stringify(configuration));
                        commit( 'setConfiguration', configuration );
                        commit('setConfigurationLoadStatus', 2);
                    })
                    .catch( function(error){
                        commit('setConfiguration', {});
                        commit('setConfigurationLoadStatus', 3);
                        helper.handleException(error);
                    });
            }
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
           state.configuration = configuration;
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
            return state.configuration;
        }

    }
};
