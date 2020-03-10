/*
|-------------------------------------------------------------------------------
| VUEX modules/quote.js
|-------------------------------------------------------------------------------
| The Vuex data store for the quote
*/

import QuoteAPI from '../api/quote';
import { helper} from '../helpers/helpers';
import i18n from '../i18n';

export const quote = {
    /*
      Defines the state being monitored for the module.
    */
    state: {
        quote: {},
        quoteLoadStatus: 0,
        quoteErrorMessage: '',
        quoteErrorFields: [],
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
                    if (error.response.data.code == 401 || error.response.data.code == 419) {
                        window.alert(i18n.t('validations.general.unauthorized'));
                        window.location.replace('/login');
                    }
                    let errorFields = Object.keys(error.response.data.errors);
                    console.log(errorFields);
                    commit( 'setQuoteLoadStatus', 3 );
                    commit( 'setQuoteErrorMessage', helper.handleException(error) );
                    commit( 'setQuoteErrorFields',  Array.isArray(errorFields) && errorFields.length ? errorFields : []);
                    commit( 'setQuote', {} );
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

        setQuoteErrorMessage( state, quoteErrorMessage ){
            state.quoteErrorMessage = quoteErrorMessage;
        },

        setQuoteErrorFields( state, quoteErrorFields ){
            state.quoteErrorFields = quoteErrorFields;
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
            return state.quote;
        },
        getQuoteErrorMessage(state) {
            return state.quoteErrorMessage;
        },
        getQuoteErrorFields(state) {
            return state.quoteErrorFields;
        }
    }
};
