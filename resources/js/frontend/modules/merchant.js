import {helper} from "../helpers/helpers";
import MerchantApi from "../api/merchant";

export const merchant = {
    state: {
        triggerLoadStatus: 0,
    },

    actions: {
        trigger( { commit }, data ){
            commit( 'setTriggerLoadStatus', 1 );
            MerchantApi.trigger(data)
                .then( function( response ){
                    commit( 'setTriggerLoadStatus', 2 );
                })
                .catch( function( error ){
                    commit( 'setTriggerLoadStatus', 3 );
                    helper.handleException(error);
                });
        },
    },
    mutations: {
        setTriggerLoadStatus(state, status) {
            state.triggerLoadStatus = status;
        }
    },
    getters: {
        getTriggerLoadStatus(state) {
            return state.triggerLoadStatus;
        },
    }
};
