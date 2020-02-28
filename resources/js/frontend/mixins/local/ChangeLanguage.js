export const ChangeLanguage = {
    mounted() {
        this.$i18n.locale = document.documentElement.lang;
    }
};
