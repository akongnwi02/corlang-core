<template>
    <div class="card overflow-auto">
        <div class="text-center card-body">
            <div class="card-text text-danger"> {{ invalid_text }} </div>
            <div class="row">
                <div class="col-6" v-show="is_prepaid">
                    <mdb-input key="meter_code" size="sm" :placeholder="$t(`dashboard.pages.tabs.content.electricity.meter_code`)" v-model="destination"></mdb-input>
                </div>

                <div class="col-6" v-show="!is_prepaid">
                    <mdb-input key="bill_number" size="sm" :placeholder="$t(`dashboard.pages.tabs.content.electricity.bill_number`)" v-model="destination"></mdb-input>
                </div>

                <div class="col-6" v-show="is_prepaid">
                    <!--put a v-if on the configuration.currency.code to avoid code not found error-->
                    <mdb-input key="amount" size="sm" :placeholder="$t(`dashboard.pages.general.amount`) +' '+ configuration.currency.code" v-model="amount"></mdb-input>
                </div>
            </div>

            <services v-on:selected="selectService" :services="services"></services>

            <search-button v-on:clicked="requestQuote" :status="quoteLoadStatus"></search-button>

            <quote-modal :service="selectedService" :quote="quote" v-on:closed="show_quote_modal=false" v-if="show_quote_modal"></quote-modal>

        </div>
    </div>
</template>

<script>

    import Services from '../services/Services'
    import { ConfigurationLoad } from '../../mixins/Configuration/ConfigurationLoad'
    import { BUSINESS_CONFIG } from "../../config/business";
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
        ],
        data() {
            return {
                // Models Fields
                destination: '',
                amount: '',
                selectedService: null,
                items: [], // not applicable

                // Component Data
                invalid_text: '',
                show_quote_modal: false
            };
        },
        computed: {
            quoteLoadStatus() {
                return this.$store.getters.getQuoteLoadStatus;
            },
            is_prepaid() {
                if (this.selectedService) {
                    return this.selectedService.is_prepaid;
                }
                return true
            },
            services(){
                let elecCategory = this.configuration.categories.filter(obj => {
                    return obj.code == BUSINESS_CONFIG.CATEGORY_ELECTRICITY_CODE;
                });
                return elecCategory[0].services
            },
            quote() {
                return this.$store.getters.getQuote;
            }
        },
        methods: {
            selectService: function(service) {
                console.log('selected', service);
                this.selectedService = service;
            },
            requestQuote() {
                if (this.validateData()) {
                    this.$store.dispatch('loadQuote',{
                        destination: this.destination,
                        destination_code: this.selectedService.code,
                        amount: this.amount,
                        currency_code: this.configuration.currency.code,
                    });
                }
            },

            validateData() {
                let invalid = 0;

                // this validation needs to be handled properly
                if (this.destination.length < 6) {
                    ++invalid;
                    if (this.is_prepaid) {
                        this.invalid_text = this.$t('validations.purchase.electricity.meter_code');
                        console.log('Invalid meter code');
                    } else {
                        console.log('Invalid bill number');
                        this.invalid_text = this.$t('validations.purchase.electricity.bill_number')
                    }
                }

                if (! BUSINESS_CONFIG.APP_REGEX_AMOUNT.test(this.amount)) {
                    if (this.is_prepaid) {
                        ++invalid;
                        console.log('Invalid amount');
                        this.invalid_text = this.$t('validations.general.business.amount');
                    }
                }


                if (! this.selectedService) {
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

                if (invalid === 0) {
                    this.invalid_text = '';
                    console.log('Validation complete. All inputs valid');
                    return true;
                }
                return false;
            }
        },
        watch: {
            quoteLoadStatus(){
                if (this.quoteLoadStatus == 3) {
                    let errorFields = this.$store.getters.getQuoteErrorFields;
                    let myFields = [];
                    if (errorFields.includes('destination')) {
                        if (this.is_prepaid) {
                            myFields.push(this.$t('dashboard.pages.tabs.content.electricity.meter_code'));
                        }
                        else {
                            myFields.push(this.$t('dashboard.pages.tabs.content.electricity.bill_number'));
                        }
                    }
                    if (errorFields.includes('amount')) {
                        myFields.push(this.$t('dashboard.pages.general.amount'));
                    }

                    this.$buefy.toast.open({
                        message: this.$store.getters.getQuoteErrorMessage + ' ' + myFields.toString().replace(',', ' '),
                        type: 'is-danger'
                    });
                }

                if (this.quoteLoadStatus == 2) {
                    this.show_quote_modal=true;




                }
            }
        }
    }
</script>
