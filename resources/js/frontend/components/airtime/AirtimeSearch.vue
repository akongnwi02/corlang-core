<template>
    <div class="text-center card-body" @keyup.enter="requestQuote">
        <div class="card-text text-danger"> {{ invalid_text }}</div>
        <div class="row">
            <div class="col-lg-6">
                <mdb-input id="phone" key="phone" :label="$t('dashboard.pages.general.phone')" v-model="destination"></mdb-input>
            </div>
            <div class="col-lg-6">
                <mdb-input key="amount"
                           :label="$t('dashboard.pages.general.amount') +' '+ currency.code"
                           v-model="amount"></mdb-input>
            </div>
        </div>

        <div v-if="airtimeServices.length >= 1">
            <strong><label class="text-muted float-left">{{ $t('dashboard.pages.tabs.content.airtime.airtime') }}</label></strong>
            <br />
            <hr />
            <div>
                <services v-on:selected="selectService" :services="airtimeServices"></services>

            </div>
        </div>

        <div v-if="dataServices.length >= 1">
            <strong><label class="text-muted float-left">{{ $t('dashboard.pages.tabs.content.airtime.data') }}</label></strong>
            <br/>
            <hr/>
            <div>
                <services v-on:selected="selectService" :services="dataServices"></services>
            </div>
        </div>

        <search-button v-on:clicked="requestQuote"></search-button>

        <quote-modal v-on:confirmed="confirm" :service="selectedService" :quote="quote"
                     v-on:closed="show_quote_modal=false" v-if="show_quote_modal"></quote-modal>
        <transaction-modal :transaction="transaction"
                           v-on:closed="show_transaction_modal=false" v-if="show_transaction_modal"></transaction-modal>
        <spinner :status="spinner_status"></spinner>
    </div>
</template>

<script>
    import Services from '../services/Services'
    import {ConfigurationLoad} from '../../mixins/Configuration/ConfigurationLoad'
    import {PusherNotification} from "../../mixins/pusher/Notification";
    import {BUSINESS_CONFIG} from "../../config/business";
    import SearchButton from "../global/SearchButton";
    import QuoteModal from './AirtimeQuoteModal';
    import TransactionModal from '../../components/global/TransactionModal'
    import Spinner from "../global/Spinner";
    import {Navigation} from "../../mixins/transaction/NavigateToTransactionDetails"
    import {mdbBtn, mdbCol, mdbRow, mdbInput} from 'mdbvue';
    import {helper} from "../../helpers/helpers";

    export default {
        name: "AirtimeSearch",
        components: {
            Spinner,
            QuoteModal,
            SearchButton,
            Services,
            TransactionModal,
            mdbBtn,
            mdbCol,
            mdbInput,
            mdbRow,
        },
        mixins: [
            ConfigurationLoad,
            PusherNotification,
            Navigation,
        ],
        data() {
            return {
                // Models Fields
                pincode: '',
                phone: '',
                destination: '',
                amount: '',
                selectedService: null,
                items: [], // not applicable

                // Component Data
                invalid_text: '',
                show_quote_modal: false,
                show_transaction_modal: false,
                spinner_status: 0,
            };
        },
        computed: {
            quoteLoadStatus() {
                return this.$store.getters.getQuoteLoadStatus;
            },
            configuration() {
                return this.$store.getters.getConfiguration;
            },
            airtimeServices() {
                let cashinCategory = this.configuration.categories.filter(obj => {
                    return obj.code == BUSINESS_CONFIG.CATEGORY_AIRTIME_CODE;
                });
                return cashinCategory[0].services
            },
            dataServices() {
                let cashoutCategory = this.configuration.categories.filter(obj => {
                    return obj.code == BUSINESS_CONFIG.CATEGORY_DATA_CODE;
                });
                return cashoutCategory[0].services
            },
            quote() {
                return this.$store.getters.getQuote;
            },
            paymentStatus() {
                return this.$store.getters.getPaymentStatus;
            },
            transaction() {
                return this.$store.getters.getTransaction;
            },
            transactionLoadStatus() {
                return this.$store.getters.getTransactionLoadStatus;
            },
            currency() {
                return this.$store.getters.getConfiguration.currency;
            }
        },
        methods: {
            selectService: function (service) {
                console.log('selected service', service);
                this.selectedService = service;
            },
            requestQuote() {
                if (this.validateData()) {
                    this.$store.dispatch('loadQuote', {
                        destination: this.destination,
                        service_code: this.selectedService.code,
                        amount: this.amount,
                        currency_code: this.configuration.currency.code,
                        phone: this.phone,
                    });
                }
            },

            validateData() {
                let invalid = 0;

                if (!this.selectedService) {
                    ++invalid;
                    console.log('No service selected');
                    this.invalid_text = this.$t('validations.purchase.service');
                }

                // this validation needs to be handled properly
                if (this.selectedService) {
                    if (this.selectedService.destination_regex) {
                        let re = new RegExp(helper.formatRegex(this.selectedService.destination_regex));

                        if (!re.test(this.destination)) {
                            ++invalid;
                            this.invalid_text = this.$t('validations.purchase.phone', {format: this.selectedService.destination_placeholder});
                            console.log('Invalid account number');
                        }
                    } else if (this.destination.length < 6) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.phone');
                        console.log('Invalid account number');
                    }
                }

                if (this.destination.length < 6) {
                    ++invalid;
                    this.invalid_text = this.$t('validations.purchase.phone');
                    console.log('Invalid account number');
                }

                if (!BUSINESS_CONFIG.APP_REGEX_AMOUNT.test(this.amount)) {
                    ++invalid;
                    console.log('Invalid amount');
                    this.invalid_text = this.$t('validations.purchase.amount');
                }

                if (invalid === 0) {
                    this.invalid_text = '';
                    console.log('Validation complete. All inputs valid');
                    return true;
                }
                return false;
            },
            confirm () {
                console.log('transaction confirmed');
                this.show_quote_modal = false;
                this.$store.dispatch('confirmPayment', {
                    id: this.quote.uuid,
                });

                this.waitForNotification(this.quote.uuid);
                console.log('waiting for callback notification on channel', this.quote.uuid);
            }
        },
        watch: {
            quoteLoadStatus() {
                this.show_quote_modal = this.quoteLoadStatus == 2;
                this.spinner_status = this.quoteLoadStatus;
            },
            // paymentStatus() {
            //     if (this.paymentStatus == 2) {
            //         this.$store.dispatch('loadTransaction', this.transaction.uuid)
            //     }
            // },
            transactionLoadStatus() {
                this.show_transaction_modal = this.transactionLoadStatus == 2 && this.paymentStatus == 2;
                this.spinner_status = this.transactionLoadStatus;
            }
        },
        deactivated() {
            this.$store.commit('setQuoteLoadStatus', 0);
            this.$store.commit('setTransactionLoadStatus', 0);
            this.$store.commit('setPaymentStatus', 0);
        }
    }
</script>

<style scoped>

</style>
