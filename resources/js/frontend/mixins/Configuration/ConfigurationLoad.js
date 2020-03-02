
export const ConfigurationLoad = {
    data() {
        return {
            configuration: null,
        }
    },
    mounted() {

        if (this.$store.getters.getConfiguration) {
            this.configuration = this.$store.getters.getConfiguration;
        } else {
            this.$store.dispatch('loadConfiguration');
        }
        this.configuration = this.$store.getters.getConfiguration;
    }
};
