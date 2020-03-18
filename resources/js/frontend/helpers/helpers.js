import i18n from '../i18n';
import {ToastProgrammatic as Toast} from 'buefy'

export const helper = {
    handleException(error) {
        // if there's no response probably internet connection error
        if (!error.response) {
            Toast.open({
                message: i18n.t('validations.general.network'),
                type: 'is-danger'
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
                if (errorFields.includes('destination')) {
                    translatedFields.push(i18n.t('dashboard.pages.general.destination'));
                }
                errorFieldsString = translatedFields.toString().replace(',', ' ')
            }

            // test error codes and handle accordingly
            if (error.response.data.code == 400) {
                errorMessage = i18n.t('validations.general.business.invalid');
            }

            if (error.response.data.code == 401 || error.response.data.code == 419) {
                errorMessage = i18n.t('validations.general.unauthorized');
                window.location.replace('/login');
            }

            if (error.response.data.code == 402) {
                errorMessage = i18n.t('validations.general.business.insufficient_balance');
            }

            if (error.response.data.code == 403) {
                errorMessage = i18n.t('validations.general.business.unauthorized');
            }

            if (error.response.data.code == 404) {
                errorMessage = i18n.t('validations.general.not_found');
            }

            if (error.response.data.code == 409) {
                errorMessage = i18n.t('validations.general.duplicate');
            }

            if (error.response.data.code == 422) {
                errorMessage = i18n.t('validations.general.invalid_input');
            }

            if (error.response.data.code == 500) {
                errorMessage = i18n.t('validations.general.server');
            }

            if (error.response.data.code == 503) {
                errorMessage = i18n.t('validations.general.maintenance');
            }

            Toast.open({
                message: errorMessage + ' ' + errorFieldsString,
                type: 'is-danger'
            });
        }

    },
};
