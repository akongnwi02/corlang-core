<template>
    <div class="text-center card-body">
        <div class="card-text text-danger"> {{ invalid_text }}</div>
        <div class="row">
            <div class="col-sm-6">
                <mdb-input key="meter_code" size="sm"
                           :placeholder="$t(`dashboard.pages.tabs.content.electricity.meter_code`)"
                           v-model="destination"></mdb-input>
            </div>

            <div class="col-sm-6">
                <!--put a v-if on the configuration.currency.code to avoid code not found error-->
                <mdb-input key="amount" size="sm"
                           :placeholder="$t(`dashboard.pages.general.amount`) +' '+ configuration.currency.code"
                           v-model="amount"></mdb-input>
            </div>
        </div>

        <mdb-row>
            <mdb-col class="col-sm-6">
                <label for="paymentMethod"><strong>{{ $t('dashboard.pages.general.method') }}</strong></label>
                <select v-model="selectedMethod" class="custom-select" id="paymentMethod" required>
                    <option v-for="method in methods" :value="method">
                        {{ method.name }}
                    </option>
                </select>
            </mdb-col>
            <mdb-col class="col-sm-6">
                <div><strong>{{ $t('dashboard.pages.general.description')}}</strong></div>
                <div>
                    <small>{{ $i18n.locale == 'en' ? selectedMethod.description_en : selectedMethod.description_fr }}</small>
                </div>
            </mdb-col>
        </mdb-row>
        <mdb-row>
            <mdb-col v-if="!selectedMethod.is_default" class="col-sm-6">
                <mdb-input key="account" size="sm" :placeholder="$t('dashboard.pages.general.account')"
                           v-model="account"></mdb-input>
            </mdb-col>
            <mdb-col v-if="selectedMethod.has_reference" class="col-sm-6">
                <mdb-input type="password" key="account" size="sm"
                           :placeholder="selectedMethod.is_default ? $t('dashboard.pages.general.pincode') : $t('dashboard.pages.general.reference')"
                           v-model="reference"></mdb-input>
            </mdb-col>
        </mdb-row>

        <services v-on:selected="selectService" :services="services"></services>

        <search-button v-on:clicked="requestQuote"></search-button>

        <quote-modal v-on:confirmed="confirm" :service="selectedService" :quote="quote"
                     v-on:closed="show_quote_modal=false" v-if="show_quote_modal"></quote-modal>

    </div>
</template>

<script>

    import Services from '../services/Services'
    import {ConfigurationLoad} from '../../mixins/Configuration/ConfigurationLoad'
    import {PusherNotification} from "../../mixins/pusher/Notification";
    import {BUSINESS_CONFIG} from "../../config/business";
    import SearchButton from "../global/SearchButton";
    import QuoteModal from './QuoteModal';

    export default {
        name: "Search",
        components: {
            QuoteModal,
            SearchButton,
            Services,
        },
        mixins: [
            ConfigurationLoad,
            PusherNotification,
        ],
        data() {
            return {
                // Models Fields
                account: '',
                reference: '',
                destination: '',
                amount: '',
                selectedService: null,
                items: [], // not applicable

                // Component Data
                invalid_text: '',
                show_quote_modal: false,
                selectedMethod: {}

            };
        },
        mounted() {
            this.selectedMethod = this.configuration.methods[0];
        },
        computed: {
            quoteLoadStatus() {
                return this.$store.getters.getQuoteLoadStatus;
            },
            configuration() {
                return this.$store.getters.getConfiguration;
            },
            services() {
                let prepaidBillCategory = this.configuration.categories.filter(obj => {
                    return obj.code == BUSINESS_CONFIG.CATEGORY_PREPAID_BILLS_CODE;
                });
                return prepaidBillCategory[0].services
            },
            quote() {
                return this.$store.getters.getQuote;
            },
            methods() {
                return this.$store.getters.getConfiguration.methods;
            },
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
                        amount: this.amount,
                        currency_code: this.configuration.currency.code,
                        method: this.selectedMethod,
                        reference: this.reference,
                        paymentmethod_code: this.account,
                    });
                }
            },

            selectMethod(method) {
                this.selectedMethod = method;
            },

            validateData() {
                let invalid = 0;

                // this validation needs to be handled properly
                if (this.destination.length < 6) {
                    ++invalid;
                    this.invalid_text = this.$t('validations.purchase.electricity.meter_code');
                    console.log('Invalid meter code');
                }

                if (!BUSINESS_CONFIG.APP_REGEX_AMOUNT.test(this.amount)) {
                    ++invalid;
                    console.log('Invalid amount');
                    this.invalid_text = this.$t('validations.general.business.amount');
                }

                if (!this.selectedService) {
                    if (this.services.length === 1) {
                        this.selectedService = this.services[0];
                        console.log('Only one service in list. Hence selected');
                    } else if (this.services.length === 0) {
                        console.log('No services available');
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.electricity.vendor_empty');
                    } else {
                        console.log('No service selected');
                        this.invalid_text = this.$t('validations.purchase.electricity.vendor');
                        ++invalid;
                    }
                }

                if (this.reference.length < 3) {
                    if (this.selectedMethod.has_reference) {
                        ++invalid;
                        this.invalid_text = this.selectedMethod.is_default ? this.$t('validations.purchase.pincode') : this.$t('validations.purchase.reference');
                        console.log('Invalid reference');
                    }
                }

                if (this.account.length < 6) {
                    if (!this.selectedMethod.is_default) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.source');
                        console.log('Invalid source');
                    }
                }

                if (invalid === 0) {
                    this.invalid_text = '';
                    console.log('Validation complete. All inputs valid');
                    return true;
                }
                return false;
            },
            confirm: function (data) {
                console.log('payment confirmed', data);
                this.show_quote_modal = false;
                this.$store.dispatch('confirmPayment', {
                    id: this.quote.uuid,
                });
                this.waitForNotification(this.quote.uuid);
                console.log('waiting for notification', this.quote.uuid);
            }
        },
        watch: {
            quoteLoadStatus() {
                if (this.quoteLoadStatus == 2) {
                    this.show_quote_modal = true;
                }
            },
        }
    }
</script>
