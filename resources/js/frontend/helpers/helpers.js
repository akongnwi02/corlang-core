import i18n from '../i18n';
import {ToastProgrammatic as Toast} from 'buefy'

export const helper = {
    handleException(error) {
        // if there's no response probably internet connection error
        if (!error.response) {
            Toast.open({
                message: i18n.t('validations.general.network'),
                type: 'is-danger',
                duration: 7000
            });
        } else {

            // else treat server error
            console.log('request failed', error.response.data);

            // extract error fields and translate
            let errorFieldsString = '';
            let errorMessage = i18n.t('validations.general.unexpected');

            if (error.response.data.errors) {
                let errorFields = Object.keys(error.response.data.errors);
                let translatedFields = [];
                if (errorFields.includes('amount')) {
                    translatedFields.push(i18n.t('dashboard.pages.general.amount'));
                }
                if (errorFields.includes('account')) {
                    translatedFields.push(i18n.t('dashboard.pages.general.account'));
                }
                if (errorFields.includes('paymentmethod_code')) {
                    translatedFields.push(i18n.t('dashboard.pages.general.method'));
                }
                if (errorFields.includes('destination')) {
                    translatedFields.push(i18n.t('dashboard.pages.general.destination'));
                }
                errorFieldsString = translatedFields.toString().replace(',', ' ')
            }

            errorMessage = i18n.t('exceptions.'+error.response.data.error_code);


            if (error.response.data.code == 503) {
                errorMessage = i18n.t('validations.general.maintenance');
            }

            Toast.open({
                message: errorMessage + ' ' + errorFieldsString,
                type: 'is-danger',
                duration: 7000
            });
        }

    },

    formatRegex(regex) {
        return regex.slice(1,-1);
    }
};
