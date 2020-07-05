<template>
    <div class="text-center card-body" @keyup.enter="requestQuote">
        <div class="card-text text-danger"> {{ invalid_text }}</div>
        <div class="row">
            <div class="col-lg-6">
                <mdb-input id="account" key="account" :label="$t('dashboard.pages.general.account')" v-model="destination"></mdb-input>
            </div>
            <div class="col-lg-6">
                <mdb-input key="amount"
                           :label="$t('dashboard.pages.general.amount') +' '+ currency.code"
                           v-model="amount"></mdb-input>
            </div>
        </div>

        <mdb-row>

            <div class="col-lg-6">
                <!--put a v-if on the configuration.currency.code to avoid code not found error-->
                <mdb-input key="phone"
                           :label="$t(`dashboard.pages.general.phone`)"
                           v-model="phone"></mdb-input>
            </div>
            <div v-if ="selectedService" class="col-lg-6">
                <mdb-input v-if="selectedService.requires_auth" :key="selectedService.auth_type"
                           :label="$t('dashboard.pages.general.' + selectedService.auth_type)"
                           v-model="auth_payload"></mdb-input>
            </div>
            <!--</mdb-col>-->
            <!--<mdb-col class="col-6">-->
            <!--<mdb-input type="password" key="pincode"-->
            <!--:label="$t('dashboard.pages.general.pincode')"-->
            <!--v-model="pincode"></mdb-input>-->
            <!--</mdb-col>-->

        </mdb-row>
        <div v-if="cashoutServices.length >= 1">
            <strong><label class="text-muted float-left">{{ $t('dashboard.pages.tabs.content.mobile_money.cashout') }}</label></strong>
            <br />
            <hr />
            <div>
                <services v-on:selected="selectService" :services="cashoutServices"></services>

            </div>
        </div>

        <div v-if="cashinServices.length >= 1">
            <strong><label class="text-muted float-left">{{ $t('dashboard.pages.tabs.content.mobile_money.cashin') }}</label></strong>
            <br/>
            <hr/>
            <div>
                <services v-on:selected="selectService" :services="cashinServices"></services>
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
    import QuoteModal from './QuoteModal';
    import TransactionModal from '../../components/global/TransactionModal'
    import Spinner from "../global/Spinner";
    import {Navigation} from "../../mixins/transaction/NavigateToTransactionDetails"
    import {mdbBtn, mdbCol, mdbRow, mdbInput} from 'mdbvue';
    import {helper} from "../../helpers/helpers";

    export default {
        name: "Search",
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
                auth_payload: '',
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
            cashinServices() {
                let cashinCategory = this.configuration.categories.filter(obj => {
                    return obj.code == BUSINESS_CONFIG.CATEGORY_SEND_MONEY_CODE;
                });
                return cashinCategory[0].services
            },
            cashoutServices() {
                let cashoutCategory = this.configuration.categories.filter(obj => {
                    return obj.code == BUSINESS_CONFIG.CATEGORY_RECEIVE_MONEY_CODE;
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
                        auth_payload: this.auth_payload,
                    });
                }
            },

            validateData() {
                let invalid = 0;

                // this validation needs to be handled properly
                if (this.selectedService) {
                    if (this.selectedService.destination_regex) {
                        let re = new RegExp(helper.formatRegex(this.selectedService.destination_regex));
                        console.log('js regex', re);
                        console.log('php regex', this.selectedService.destination_regex);
                        if (!re.test(this.destination)) {
                            ++invalid;
                            this.invalid_text = this.$t('validations.purchase.mobile_money.account_number', {format: this.selectedService.destination_placeholder});
                            console.log('Invalid account number');
                        }
                    } else if (this.destination.length < 6) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.mobile_money.account_number');
                        console.log('Invalid account number');
                    }
                    if (this.amount < this.selectedService.min_amount) {
                        ++invalid;
                        console.log('Amount is small');
                        this.invalid_text = this.$t('validations.purchase.min_amount', {min_amount: this.selectedService.min_amount});
                    }
                    if (this.amount > this.selectedService.max_amount) {
                        ++invalid;
                        console.log('Amount is big');
                        this.invalid_text = this.$t('validations.purchase.max_amount', {max_amount: this.selectedService.max_amount});
                    }
                    if (this.amount % this.selectedService.step_amount !== 0) {
                        ++invalid;
                        console.log('Invalid amount multiple');
                        this.invalid_text = this.$t('validations.purchase.step_amount', {step_amount: this.selectedService.step_amount});
                    }
                }

                if (this.destination.length < 6) {
                    ++invalid;
                    this.invalid_text = this.$t('validations.purchase.mobile_money.account_number');
                    console.log('Invalid account number');
                }

                if (!BUSINESS_CONFIG.APP_REGEX_AMOUNT.test(this.amount)) {
                    ++invalid;
                    console.log('Invalid amount');
                    this.invalid_text = this.$t('validations.purchase.amount');
                }

                if (!this.selectedService) {
                    console.log('No service selected');
                    this.invalid_text = this.$t('validations.purchase.service');
                }

                if (this.auth_payload.length < 3) {
                    if (this.selectedService.requires_auth) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.' + this.selectedService.auth_type);
                        console.log('Invalid auth payload entered. Too short');
                    }
                }
                //
                // if (this.pincode.length < 3) {
                //     ++invalid;
                //     this.invalid_text = this.$t('validations.purchase.pincode');
                //     console.log('Invalid pincode');
                // }
                //
                // if (this.phone.length < 9) {
                //     ++invalid;
                //     this.invalid_text = this.$t('validations.purchase.phone');
                //     console.log('Invalid phone number');
                // }

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
                if (this.quoteLoadStatus == 2) {
                    this.show_quote_modal = true;
                } else {
                    this.show_quote_modal = false;
                }
                this.spinner_status = this.quoteLoadStatus;
            },
            // paymentStatus() {
            //     if (this.paymentStatus == 2) {
            //         this.$store.dispatch('loadTransaction', this.transaction.uuid)
            //     }
            // },
            transactionLoadStatus() {
                if (this.transactionLoadStatus == 2 && this.paymentStatus == 2) {
                    this.show_transaction_modal = true;
                } else {
                    this.show_transaction_modal = false;
                }
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
