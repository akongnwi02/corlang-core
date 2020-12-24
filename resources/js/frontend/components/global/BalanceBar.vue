<template>
    <div class="row">
        <div>
            <a href="#" @click="showTopupModal"> {{$t('dashboard.pages.general.add_money')}}</a>
        </div>
        <div v-if="!accountIsEmpty" class="text-value-lg ml-3"><h4><strong>{{ currency(account.balance)}}</strong></h4></div>
        <topup-modal v-on:topup="quoteTopup" v-on:closed="show_topup_modal=false" v-show="show_topup_modal==true"></topup-modal>
        <quote-modal v-on:confirmed="confirmTopup" :service="topup_method" :quote="quote"
                     v-on:closed="show_quote_modal=false" v-if="show_quote_modal"></quote-modal>
    </div>
</template>

<script>
    import {currency} from "../../helpers/currency";
    import TopupModal from "../../components/account/TopupModal";
    import QuoteModal from "../../components/mobile-money/QuoteModal";
    import {ConfigurationLoad} from "../../mixins/Configuration/ConfigurationLoad";

    export default {
        name: "BalanceBar",
        components: {
            TopupModal,
            QuoteModal
        },
        mixins: [
            ConfigurationLoad
        ],
        data() {
            return {
                show_topup_modal: false,
                show_quote_modal: false,
                topup_method: {}
            }
        },
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
            quoteLoadStatus() {
                return this.$store.getters.getQuoteLoadStatus;
            },
            quote() {
                return this.$store.getters.getQuote;
            },
            paymentMethods() {
                return this.$store.getters.getConfiguration.payout_methods
            },
        },
        methods: {
            currency(amount) {
                return currency.format(amount, this.account.currency_code);
            },
            showTopupModal() {
                this.show_topup_modal = true;
            },
            showPayoutModal() {
                this.show_payout_modal = true;
            },
            quoteTopup(data) {
                console.log('topup data', data);
                this.topup_method = data.selectedMethod.service;
                this.show_topup_modal = false;

                this.$store.dispatch('loadQuote', {
                    destination: data.paymentaccount,
                    service_code: data.selectedMethod.service.code,
                    amount: data.amount,
                    currency_code: data.currency_code,
                    auth_payload: data.auth_payload,
                    phone: this.phone,
                });
            },
            confirmTopup(data) {
                console.log('transaction confirmed');
                this.show_quote_modal = false;
                this.$store.dispatch('confirmPayment', {
                    id: this.quote.uuid,
                });
                this.waitForNotification(this.quote.uuid);
                console.log('waiting for callback notification on channel', this.quote.uuid);
            },
        },
        watch: {
            quoteLoadStatus() {
                if (this.quoteLoadStatus == 2) {
                    this.show_quote_modal = true;
                } else {
                    this.show_quote_modal = false;
                }
            },
        }
    }
</script>

<style scoped>

</style>
