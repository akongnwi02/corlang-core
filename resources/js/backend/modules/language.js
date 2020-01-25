export const language = {
    state: {
        curLanguage: 'en'
    },

    actions: {
        changeLanguage( { commit }, data ){
            commit( 'setLanguage', data.lang );
        }
    },

    mutations: {
        setLanguage(state, language) {
            state.curLanguage = language
        }
    }
};