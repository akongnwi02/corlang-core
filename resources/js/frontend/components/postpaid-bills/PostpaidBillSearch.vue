<template>
    <div class="text-center card-body" @keyup.enter="requestQuote">
        <div class="card-text text-danger"> {{ invalid_text }}</div>
        <div class="row">
            <div class="col-6">
                <mdb-input key="meter_code"
                           :label="$t(`dashboard.pages.tabs.content.electricity.bill_number`)"
                           v-model="destination"></mdb-input>
            </div>
            <div class="col-6">
                <!--put a v-if on the configuration.currency.code to avoid code not found error-->
                <mdb-input key="phone"
                           :label="$t(`dashboard.pages.general.phone`)"
                           v-model="phone"></mdb-input>
            </div>
        </div>

        <services v-on:selected="selectService" :services="services"></services>

        <search-button v-on:clicked="requestQuote"></search-button>

        <quote-modal v-on:confirmed="confirm" :service="selectedService" :quote="quote"
                     v-on:closed="show_quote_modal=false" v-if="show_quote_modal"></quote-modal>
        <transaction-modal :transaction="transaction"
                           v-on:closed="show_transaction_modal=false" v-if="show_transaction_modal"></transaction-modal>

        <spinner :status="spinner_status"></spinner>
    </div>
</template>

<script>

    import Services from '../services/Services';
    import {ConfigurationLoad} from '../../mixins/Configuration/ConfigurationLoad';
    import {PusherNotification} from "../../mixins/pusher/Notification";
    import {BUSINESS_CONFIG} from "../../config/business";
    import SearchButton from "../global/SearchButton";
    import QuoteModal from './PostpaidBillQuoteModal';
    import TransactionModal from '../../components/global/TransactionModal'
    import Spinner from "../global/Spinner";
    import {Navigation} from "../../mixins/transaction/NavigateToTransactionDetails"
    import {mdbInput} from 'mdbvue';
    import {helper} from "../../helpers/helpers";


    export default {
        name: "PostpaidBillSearch",
        components: {
            Spinner,
            QuoteModal,
            SearchButton,
            Services,
            TransactionModal,
            mdbInput
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
            services() {
                let postpaidBillCategory = this.configuration.categories.filter(obj => {
                    return obj.code == BUSINESS_CONFIG.CATEGORY_POSTPAID_BILLS_CODE;
                });
                return postpaidBillCategory[0].services
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
            }
        },
        methods: {
            selectService: function (service) {
                console.log('selected', service);
                this.selectedService = service;
            },
            requestQuote() {
                if (this.validateData()) {
                    this.$store.dispatch('loadQuote', {
                        destination: this.destination,
                        service_code: this.selectedService.code,
                        phone: this.phone,
                    });
                }
            },

            validateData() {
                let invalid = 0;

                // this validation needs to be handled properly
                if (this.selectedService) {
                    if (this.selectedService.destination_regex) {
                        let re = new RegExp(helper.formatRegex(this.selectedService.destination_regex));
                        if (!re.test(this.destination)) {
                            ++invalid;
                            this.invalid_text = this.$t('validations.purchase.electricity.bill_number', {format: this.selectedService.destination_placeholder});
                            console.log('Invalid bill number');
                        }
                    } else if (this.destination.length < 6) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.electricity.bill_number');
                        console.log('Invalid bill number');
                    }
                }

                if (this.destination.length < 6) {
                    ++invalid;
                    this.invalid_text = this.$t('validations.purchase.electricity.bill_number');
                    console.log('Invalid bill number. Too short');
                }

                if (!this.selectedService) {
                    if (this.services.length === 1) {
                        this.selectedService = this.services[0];
                        console.log('Only one service in list. Hence selected');
                    } else if (this.services.length === 0) {
                        console.log('No services available');
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.empty_service');
                    } else {
                        console.log('No service selected');
                        this.invalid_text = this.$t('validations.purchase.service');
                        ++invalid;
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
