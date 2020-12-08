<template>
    <div class="text-center card-body" @keyup.enter="searchBills()">
        <div class="card-text text-danger"> {{ invalid_text }}</div>
        <div class="row">
            <div class="col-lg-6">
                <mdb-input key="destination"
                           :label="$t(`dashboard.pages.tabs.content.postpaid.bill_contract`)"
                           v-model="destination"></mdb-input>
            </div>
            <div class="col-lg-6">
                <!--put a v-if on the configuration.currency.code to avoid code not found error-->
                <mdb-input key="phone"
                           :label="$t(`dashboard.pages.general.phone`)"
                           v-model="phone"></mdb-input>
            </div>

            <div v-if="bills.length > 0" class="col-lg-6">
                <label for="plan"><strong>{{ $t('dashboard.pages.tabs.content.postpaid.select_bill') }}</strong></label>
                <select v-model="selectedBill" class="custom-select" id="plan" required>
                    <option v-for="bill in bills" :value="bill">
                        {{ bill.bill_gen_date }} - {{ bill.bill_number }}
                    </option>
                </select>
            </div>
            <div class="col-lg-6" v-if="selectedBill">
                <mdb-input key="amount"
                   :label="$t('dashboard.pages.general.amount') +' '+ selectedBill.currency_code"
                           :value="selectedBill.amount"
                   disabled>
                </mdb-input>
            </div>
            <div class="col-lg-12" v-if="selectedBill">
                <label>{{ selectedBill.type }}</label>
            </div>
        </div>
        <br/>

        <hr/>
        <services v-on:selected="selectService" :services="services"></services>

        <search-button v-on:clicked="requestQuote"></search-button>
        <mdb-btn class="float-right" size="sm" color="secondary" @click.native="searchBills()">{{ $t('dashboard.pages.tabs.content.postpaid.search') }}</mdb-btn>

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
    import {mdbBtn} from 'mdbvue';
    import {helper} from "../../helpers/helpers";
    import {currency} from "../../helpers/currency";

    export default {
        name: "PostpaidBillSearch",
        components: {
            Spinner,
            QuoteModal,
            SearchButton,
            Services,
            TransactionModal,
            mdbInput,
            mdbBtn
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
                selectedBill: null,
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
            },
            billsLoadStatus() {
                return this.$store.getters.getBillsSearchStatus;
            },
            bills() {
                return this.$store.getters.getBills;
            }
        },
        methods: {
            selectService: function (service) {
                console.log('selected', service);
                this.selectedService = service;
            },
            requestQuote() {
                if (this.validateData()) {
                    if (this.bills.length == 0) {
                        this.invalid_text = this.$t('validations.purchase.postpaid.search_bills');
                        return;
                    }
                    if (!this.selectedBill) {
                        this.invalid_text = this.$t('validations.purchase.postpaid.select_bill');
                        return;
                    }

                    this.$store.dispatch('loadQuote', {
                        destination: this.destination,
                        item: this.selectedBill.bill_number,
                        service_code: this.selectedService.code,
                        phone: this.phone,
                    });
                }
            },
            searchBills() {
                if(this.validateData()) {
                    this.selectedBill = null;
                    this.bills = [];
                    this.$store.dispatch('searchBills', {
                        destination: this.destination,
                        service_code: this.selectedService.code,
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
                            this.invalid_text = this.$t('validations.purchase.postpaid.bill_contract');
                            console.log('Invalid bill or contract number');
                        }
                    } else if (this.destination.length < 6) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.postpaid.bill_contract');
                        console.log('Invalid bill or contract number. Too short');
                    }
                }

                if (this.destination.length < 6) {
                    ++invalid;
                    this.invalid_text = this.$t('validations.purchase.postpaid.bill_contract');
                    console.log('Invalid bill or contract number. Too short');
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
            },
            currencyFormat(amount) {
                return currency.format(amount, this.quote.currency_code)
            },
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
            },
            billsLoadStatus() {
                this.spinner_status = this.billsLoadStatus;
                if (this.billsLoadStatus == 2) {
                    if (this.bills.length == 1) {
                        this.selectedBill = this.bills[0];
                    }
                }
            }
        },
        deactivated() {
            this.$store.commit('setQuoteLoadStatus', 0);
            this.$store.commit('setTransactionLoadStatus', 0);
            this.$store.commit('setPaymentStatus', 0);
        }
    }
</script>
