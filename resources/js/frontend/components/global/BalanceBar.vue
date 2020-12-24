<template>
    <div class="row">
        <div>
            <a href="#" @click="navigateToTopUp"> {{$t('dashboard.pages.general.add_money')}}</a>
        </div>
        <div v-if="!accountIsEmpty" class="text-value-lg ml-3"><h4><strong>{{ currency(account.balance)}}</strong></h4></div>
    </div>
</template>

<script>
    import {currency} from "../../helpers/currency";
    import {ConfigurationLoad} from "../../mixins/Configuration/ConfigurationLoad";

    export default {
        name: "BalanceBar",
        mixins: [
            ConfigurationLoad
        ],
        created() {
            this.$store.dispatch('getAccount');
        },
        computed: {
            account() {
                return this.$store.getters.getAccount;
            },
            accountIsEmpty() {
                return Object.keys(this.account).length === 0;
            },
        },
        methods: {
            currency(amount) {
                return currency.format(amount, this.account.currency_code);
            },
            navigateToTopUp() {
                this.$store.commit('setPage', 'account');
                this.$store.commit('setShowTopupModal', true);
            }
        }
    }
</script>

<style scoped>

</style>
