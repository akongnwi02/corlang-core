<template>
    <div style="height:100%">
        <mdb-card>
            <mdb-card-body flex layout="row" class="text-center">
                <mdb-card-title> {{ $t(`dashboard.pages.tabs.content.electricity.title`) }} </mdb-card-title>
                <mdb-card-text> {{ $t(`dashboard.pages.tabs.content.electricity.description`) }} </mdb-card-text>
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
                    <mdb-col md="6" v-if="is_prepaid">
                        <mdb-input :label="$t(`dashboard.pages.tabs.content.electricity.meter_code`)" v-model="destination"></mdb-input>
                    </mdb-col>

                    <mdb-col md="6" v-if="!is_prepaid">
                        <mdb-input :label="$t(`dashboard.pages.tabs.content.electricity.bill_number`)" v-model="destination"></mdb-input>
                    </mdb-col>

                    <mdb-col md="6" v-if="is_prepaid">
                        <mdb-input :label="$t(`dashboard.pages.tabs.content.electricity.amount`) + ' (XAF)'" v-model="amount"></mdb-input>
                    </mdb-col>
                </mdb-row>
                <div class="row">
                    <div v-for="service in services" class="col-md-4">
                        <div class="thumbnail">
                            <img :src="service.logo_url" :alt="service.name" style="width:50%">
                            <div class="caption">
                                <p>{{service.name}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <mdb-btn class="float-right" color="primary">{{ $t(`dashboard.pages.tabs.content.electricity.next`) }}</mdb-btn>
                </div>

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

                // Business Data
                services: []
            };
        },
        methods: {
            filterServices(){
                if (this.configuration) {
                    let elecCategory = this.configuration.categories.filter(obj => {
                        return obj.code === BUSINESS_CONFIG.ELECTRICITY_CODE;
                    });
                    this.services = elecCategory[0].services.filter(obj => {
                        return obj.is_prepaid == this.is_prepaid;
                    });
                }
            }
        },

        watch: {
            configuration() {
                this.filterServices();
            },
            is_prepaid() {
                this.filterServices();
            }
        },
    }

</script>
