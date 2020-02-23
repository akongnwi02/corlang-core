import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use( VueI18n );

const messages = {
    en: require('./locales/en.json'),
    fr: require('./locales/fr.json')
};

// Create VueI18n instance with options
export default new VueI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages,
    silentFallbackWarn: false
});
