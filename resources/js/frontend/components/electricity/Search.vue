<template>
    <div style="height:100%">
        <mdb-card>
            <mdb-card-body flex layout="row" class="text-center">
                <mdb-card-title> {{ $t(`dashboard.pages.tabs.content.electricity.title`) }} </mdb-card-title>
                <mdb-card-text class="text-danger"> {{ invalid_text }} </mdb-card-text>
                <div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="prepaid" :value='true' v-model="is_prepaid">
                        <label class="custom-control-label" for="prepaid">{{ $t(`dashboard.pages.tabs.content.electricity.prepaid`) }}</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="postpaid" :value='false' v-model="is_prepaid">
                        <label class="custom-control-label" for="postpaid">{{ $t(`dashboard.pages.tabs.content.electricity.postpaid`) }}</label>
                    </div>
                </div>
                <mdb-row>
                    <mdb-col md="6" v-show="is_prepaid">
                        <mdb-input :label="$t(`dashboard.pages.tabs.content.electricity.meter_code`)" v-model="destination"></mdb-input>
                        <div class="invalid-feedback">
                        Please provide a valid state.</div>
                    </mdb-col>

                    <mdb-col md="6" v-show="!is_prepaid">
                        <mdb-input :label="$t(`dashboard.pages.tabs.content.electricity.bill_number`)" v-model="destination"></mdb-input>
                    </mdb-col>

                    <mdb-col md="6" v-show="is_prepaid">
                        <mdb-input :label="$t(`dashboard.pages.tabs.content.electricity.amount`) + ' (XAF)'" v-model="amount"></mdb-input>
                    </mdb-col>
                </mdb-row>

                <keep-alive>

                    <services v-on:selected="serviceSelected" :services="services"></services>

                </keep-alive>

                <mdb-card-footer class="mt-4">
                    <mdb-btn @click="requestQuote()" size="sm" class="float-right" color="primary">{{ $t(`dashboard.pages.tabs.content.electricity.next`) }}</mdb-btn>
                </mdb-card-footer>

            </mdb-card-body>
        </mdb-card>
    </div>
</template>

<script>

    import Services from '../services/Services'
    import { ConfigurationLoad } from '../../mixins/Configuration/ConfigurationLoad'
    import { BUSINESS_CONFIG } from "../../config/business";

    export default {
        name: "Search",
        components: {
            Services
        },
        mixins: [
            ConfigurationLoad,
        ],
        data() {
            return {
                // Models Fields
                is_prepaid: true,
                destination: '',
                amount: '',
                services: [],
                selectedService: null,

                // Component Data
                invalid_text: '',
            };
        },
        methods: {
            filterServices(){
                if (this.configuration) {
                    let elecCategory = this.configuration.categories.filter(obj => {
                        return obj.code == BUSINESS_CONFIG.CATEGORY_ELECTRICITY_CODE;
                    });
                    this.services = elecCategory[0].services.filter(obj => {
                        return obj.is_prepaid == this.is_prepaid;
                    });
                }
            },
            serviceSelected: function(service) {
                console.log('service from event', service);
                this.selectedService = service;
            },
            requestQuote() {
                if (this.validateData()) {

                }
            },

            validateData() {
                let invalid = 0;

                if (!this.selectedService) {
                    if (this.services.length === 1) {
                        this.selectedService = services[0];
                        console.log('Only one service in list. Hence selected');
                    } else {
                        console.log('No service selected');
                        this.invalid_text = this.$t('validations.purchase.electricity.vendor');
                        ++invalid;
                    }
                }

                // this validation needs to be handled properly
                if (this.destination.length < 6) {
                    ++invalid;
                    if (this.is_prepaid) {
                        this.invalid_text = this.$t('validations.purchase.electricity.meter_code');
                        console.log('Invalid bill number');
                    } else {
                        console.log('Invalid meter code');
                        this.invalid_text = this.$t('validations.purchase.electricity.bill_number')
                    }
                }

                if (! BUSINESS_CONFIG.APP_REGEX_AMOUNT.test(this.amount)) {
                    if (this.is_prepaid) {
                        ++invalid;
                        console.log('Invalid amount');
                        this.invalid_text = this.$t('validations.purchase.electricity.amount');
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
            configuration() {
                this.filterServices();
            },
            is_prepaid() {
                this.filterServices();
            },
        },
    }

</script>
