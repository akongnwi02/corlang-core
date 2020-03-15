
export const ConfigurationLoad = {
    created() {
        this.$store.dispatch('loadConfiguration');
    },
    computed: {
        configurationLoadStatus() {
            return this.$store.getters.getConfigurationLoadStatus;
        },
        configuration() {
            return this.$store.getters.getConfiguration;
        }
    },
};
