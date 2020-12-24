export const navigation = {
    state: {
        page: 'purchase',
        show_topup_modal: false,
    },

    actions: {

    },
    mutations: {
        setPage(state, page) {
            state.page = page;
        },
        setShowTopupModal(state, show_topup_modal) {
            state.show_topup_modal = show_topup_modal
        }
    },
    getters: {
        getPage(state) {
            return state.page;
        },
        getShowTopupModal(state) {
            return state.show_topup_modal
        }
    }
};
