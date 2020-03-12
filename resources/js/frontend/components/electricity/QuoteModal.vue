<template>
    <mdb-modal :show="showModal" @close="$emit('closed')" class="text-center">
        <mdb-modal-header>
            <mdb-modal-title>{{ $t('dashboard.pages.general.summary') }}</mdb-modal-title>
            <span class="text-danger">{{ invalid_text }}</span>
        </mdb-modal-header>
        <mdb-modal-body>
            <mdb-row>
                <mdb-col class="col-sm-3">
                    <img :src="'/storage/' + service.logo_url" :alt="$t('dashboard.pages.general.logo')">
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
                        {{ service.is_prepaid ? $t('dashboard.pages.tabs.content.electricity.meter_code')
                        : $t('dashboard.pages.tabs.content.electricity.bill_number')}}:
                        <strong>{{ quote.destination }}</strong>
                    </li>
                    <li>
                        {{ $t('dashboard.pages.general.amount')}}:
                        <strong>{{ currencyFormat(quote.amount) }}</strong>
                    </li>
                    <li v-if="service.is_prepaid">
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
                    <li>
                        {{ $t('dashboard.pages.general.fee')}}:
                        <strong>{{ currencyFormat(quote.fee) }}</strong>
                    </li>
                    <li>
                        {{ $t('dashboard.pages.general.total')}}:
                        <strong>{{ currencyFormat(quote.total) }}</strong>
                    </li>
                </ul>
            </mdb-row>
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
                        <small>{{$i18n.locale == 'en' ? selectedMethod.description_en : selectedMethod.description_fr }}</small>
                    </div>
                </mdb-col>
            </mdb-row>
            <mdb-row>
                <mdb-col v-if="!selectedMethod.is_default" class="col-sm-6">
                    <mdb-input key="account" size="sm" :placeholder="$t('dashboard.pages.general.account')" v-model="account"></mdb-input>
                </mdb-col>
                <mdb-col v-if="selectedMethod.has_reference" class="col-sm-6">
                    <mdb-input key="account" size="sm" :placeholder="$t('dashboard.pages.general.reference')" v-model="reference"></mdb-input>
                </mdb-col>
            </mdb-row>
        </mdb-modal-body>
        <mdb-modal-footer>
            <mdb-btn size="sm" color="secondary" @click.native="$emit('closed')">{{ $t('dashboard.pages.general.close') }}</mdb-btn>
            <mdb-btn v-bind:class="{disabled: paymentStatus==1}" size="sm" color="primary" @click.native="confirm()">{{ $t('dashboard.pages.general.confirm') }}</mdb-btn>
        </mdb-modal-footer>
    </mdb-modal>
</template>

<script>
    import Input from "buefy";
    import { currency} from "../../helpers/currency";

    export default {
        name: "QuoteModal",
        components: {Input},
        data(){
            return {
                account: '',
                reference: '',
                selectedMethod: this.$store.getters.getConfiguration.methods[0],

                // component data
                invalid_text: ''
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
            methods() {
                return this.$store.getters.getConfiguration.methods;
            },
            paymentStatus() {
                return this.$store.getters.getPaymentStatus;
            }
        },
        methods: {
            selectMethod(method) {
                this.selectedMethod = method;
            },
            currencyFormat(amount) {
                return currency.format(amount, this.quote.currency)
            },
            confirm() {
                if (this.validate()) {
                    this.$emit('confirmed', {
                        method: this.selectedMethod,
                        reference: this.reference,
                        account: this.account
                    });
                }
            },
            validate() {
                let invalid = 0;

                // this validation needs to be handled properly
                if (this.reference.length < 3) {
                    if (this.selectedMethod.has_reference) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.reference');
                        console.log('Invalid reference');
                    }
                }

                if (this.account.length < 6) {
                    if (! this.selectedMethod.is_default) {
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
            }
        }
    }
</script>
