<template>
        <mdb-modal :show="showModal" @close="$emit('closed')" class="text-center">
            <mdb-modal-header>
                <mdb-modal-title>{{ $t('dashboard.pages.general.summary') }}</mdb-modal-title>
            </mdb-modal-header>
            <mdb-modal-body>
                <mdb-row>
                    <mdb-col class="col-sm-3">
                        <img :src="'/storage/' + service.logo_url" alt="Card image cap">
                    </mdb-col>
                    <mdb-col class="col-sm-9">
                        <strong>{{ service.name }}</strong>
                        <!--<mdb-card-text>{{ service.description }}</mdb-card-text>-->
                    </mdb-col>
                </mdb-row>
                <hr>
                <mdb-row class="justify-content-center">
                    <ul>
                        <li>
                            {{ service.is_prepaid ? $t('dashboard.pages.tabs.content.electricity.bill_number')
                            : $t('dashboard.pages.tabs.content.electricity.meter_code')}}:
                            <strong>{{ quote.destination }}</strong>
                        </li>
                        <li>
                            {{ $t('dashboard.pages.general.amount')}}:
                            <strong>{{ quote.amount + ' ' + quote.currency}}</strong>
                        </li>
                        <li>
                            {{ $t('dashboard.pages.tabs.content.electricity.asset')}}:
                            <strong>{{ quote.asset }}</strong>
                        </li>
                        <li>
                            {{ $t('dashboard.pages.general.customer.name')}}:
                            <strong>{{ quote.name }}</strong>
                        </li>
                        <li>
                            {{ $t('dashboard.pages.general.customer.address')}}:
                            <strong>{{ quote.address }}</strong>
                        </li>
                    </ul>
                </mdb-row>
                <mdb-row>
                    <mdb-col class="col-sm-6">
                        <label for="paymentMethod">{{ $t('dashboard.pages.general.method')}}</label>
                        <select class="custom-select" id="paymentMethod" required v-model="selectedMethod">
                            <option v-for="method in configuration.methods" >
                                {{ method.name }}
                            </option>
                        </select>
                    </mdb-col>
                    <mdb-col class="col-sm-6">
                        <div>{{ $t('dashboard.pages.general.description')}}</div>
                        <div>
                            <h5>{{$i18n.locale == 'en' ? selectedMethod.description_en : selectedMethod.description_fr }}</h5>
                        </div>
                    </mdb-col>
                </mdb-row>
                <mdb-row>
                    <mdb-col class="col-sm-6">
                        <li>
                            <p>20 GB Of Storage</p>
                        </li>
                        <li>
                            <p>2 Email Accounts</p>
                        </li>
                    </mdb-col>
                    <mdb-col class="col-sm-6">
                        <li>
                            <p>20 GB Of Storage</p>
                        </li>
                        <li>
                            <p>2 Email Accounts</p>
                        </li>
                    </mdb-col>

                </mdb-row>
            </mdb-modal-body>
            <mdb-modal-footer>
                <mdb-btn size="sm" color="secondary" @click.native="$emit('closed')">{{ $t('dashboard.pages.general.close') }}</mdb-btn>
                <mdb-btn size="sm" color="primary">{{ $t('dashboard.pages.general.confirm') }}</mdb-btn>
            </mdb-modal-footer>
        </mdb-modal>
</template>

<script>
    import Input from "buefy";
    export default {
        name: "QuoteModal",
        components: {Input},
        data(){
            return {
                selectedMethod: this.$store.getters.getConfiguration.methods[0],
            }
        },
        props: [
            'showModal',
            'quote',
            'service',
        ],
        computed: {
            configuration() {
                console.log(this.$i18n.locale);
                return this.$store.getters.getConfiguration;
            },
        }
    }
</script>
