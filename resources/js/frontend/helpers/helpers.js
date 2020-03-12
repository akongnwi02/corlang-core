import i18n from '../i18n';

export const helper = {
    handleException(error) {
        console.log('request failed', error.response.data);
        if (error.response.data.code == 400) {
            return i18n.t('validations.general.business.invalid', {parameter: 'tobe changed'});
        }

        if (error.response.data.code == 402) {
            return i18n.t('validations.general.business.insufficient_balance');
        }

        if (error.response.data.code == 403) {
            return i18n.t('validations.general.business.unauthorized');
        }

        if (error.response.data.code == 404) {
            return i18n.t('validations.general.not_found');
        }

        if (error.response.data.code == 422) {
            return i18n.t('validations.general.invalid_input');
        }

        if (error.response.data.code == 500) {
            return i18n.t('validations.general.server');
        }
    },
};
