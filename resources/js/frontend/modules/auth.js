import {helper} from "../helpers/helpers";
import AuthApi from "../api/auth";

export const auth = {
    state: {
        user: {},
        userLoadStatus: 0,
    },

    actions: {
        loadUser( { commit } ){
            commit( 'setUserLoadStatus', 1 );

            AuthApi.me()
                .then( function( response ){
                    commit( 'setUser', response.data );
                    commit( 'setUserLoadStatus', 2 );
                })
                .catch( function( error ){
                    commit( 'setUserLoadStatus', 3 );
                    helper.handleException(error);
                    commit( 'setUser', {} );
                });
        },
    },
    mutations: {
        setUserLoadStatus(state, status) {
            state.userLoadStatus = status;
        },
        setUser(state, user) {
            state.user = user;
        }
    },
    getters: {
        getUserLoadStatus(state) {
            return state.userLoadStatus;
        },
        getUser(state) {
            return state.user
        }
    }
};
