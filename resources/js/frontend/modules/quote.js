/*
|-------------------------------------------------------------------------------
| VUEX modules/quote.js
|-------------------------------------------------------------------------------
| The Vuex data store for the quote
*/

import QuoteAPI from '../api/quote';
import { helper} from "../helpers/helpers";

export const quote = {
    /*
      Defines the state being monitored for the module.
    */
    state: {
        quote: {},
        quoteLoadStatus: 0,
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

            QuoteAPI.quote(data)
                .then( function( response ){
                    commit( 'setQuote', response.data );
                    commit( 'setQuoteLoadStatus', 2 );
                })
                .catch( function( error ){
                    helper.handleException(error);
                    commit( 'setQuote', {} );
                    commit( 'setQuoteLoadStatus', 3 );
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
        setQuoteLoadStatus( state, status ){
            state.quoteLoadStatus = status;
        },

        /*
          Set the quote
        */
        setQuote( state, quote ){
            state.quote = quote;
        },
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

        /*
          Returns the quote
        */
        getQuote( state ){
            return state.quote
        },
    }
};
