<template>
    <div class="col-md-5">
        <div v-if="triggerLoadStatus==2" class="card border-0">
            <div class="card-body">
                <div class="row text-center">
                    <br><br>
                    <div class><h2 style="color:#0fad00">{{$t('dashboard.merchant.payment.success')}}</h2></div>
                    <div>
                        <h3 v-if="order.customer && order.customer.name">{{$t('dashboard.merchant.payment.dear')}}, {{order.customer.name}}</h3>
                        <p style="font-size:20px;color:#5C5C5C;">{{$t('dashboard.merchant.payment.thank_you')}}</p>
                        <p>{{ $i18n.locale == 'en' ? selectedMethod.description_en : selectedMethod.description_fr }}</p>
                        <a :href="order.return_url" class="btn btn-success col-md-7 col-lg-6 mx-auto">     {{$t('dashboard.merchant.payment.return')}}      </a>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="card border-0">
            <div class="card-header pb-0">
                <p class="card-text text-muted mt-4 space">{{$t('dashboard.merchant.payment.method')}}</p>
            </div>
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col">
                        <p class="text-muted mb-2"></p>
                        <Services v-on:selected="selectMethod" :services="methods"></Services>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="form-group">
                    <label for="account_number" class="small text-muted mb-1">{{$t('dashboard.merchant.payment.account_number')}}</label>
                    <input type="text" class="form-control form-control-sm" name="account_number" id="account_number" v-model="destination" :placeholder="$t(selectedMethod ? selectedMethod.placeholder_text : 'dashboard.merchant.payment.account_number')">
                    <div class="text text-danger">{{invalid_text}}</div>
                </div>
                <!--<div class="form-group"> <label for="NAME" class="small text-muted mb-1">NAME ON CARD</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="BBBootstrap Team"> </div>-->
                <!--<div class="form-group"> <label for="NAME" class="small text-muted mb-1">CARD NUMBER</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="4534 5555 5555 5555"> </div>-->
                <!--<div class="row no-gutters">-->
                    <!--<div class="col-sm-6 pr-sm-2">-->
                        <!--<div class="form-group"> <label for="NAME" class="small text-muted mb-1">VALID THROUGH</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="06/21"> </div>-->
                    <!--</div>-->
                    <!--<div class="col-sm-6">-->
                        <!--<div class="form-group"> <label for="NAME" class="small text-muted mb-1">CVC CODE</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="183"> </div>-->
                    <!--</div>-->
                <!--</div>-->
                <div class="row mb-5 mt-4 ">
                    <div class="col-md-7 col-lg-6 mx-auto"><button @click="triggerPayment" :disabled="triggerLoadStatus==1" type="button" class="btn btn-block btn-outline-primary btn-lg">{{$t('dashboard.merchant.payment.checkout') + ' ' + currencyFormat(order.total_amount)}}</button></div>
                </div>
            </div>
        </div>
        <spinner :status="spinner_status"></spinner>
    </div>
</template>

<script>
    import Services from "../services/Services";
    import Spinner from "../global/Spinner";
    import {helper} from "../../helpers/helpers";
    import {currency} from "../../helpers/currency";

    export default {
        name: "Checkout",
        components: {Spinner, Services},
        props: [
            'order',
            'methods',
        ],
        data() {
            return {
                spinner_status: 0,
                invalid_text: '',

                selectedMethod: null,
                destination: ''
            }
        },
        computed: {
            triggerLoadStatus() {
                return this.$store.getters.getTriggerLoadStatus;
            }
        },
        methods: {
            selectMethod(method) {
                this.selectedMethod = method;
            },
            triggerPayment() {
                if (this.validateData()) {
                    console.log('All data valid');
                    this.$store.dispatch('trigger', {
                        destination: this.destination,
                        paymentmethod_code: this.selectedMethod.code,
                        uuid: this.order.uuid,
                    });
                }
            },
            validateData() {
                let invalid = 0;
                if (this.selectedMethod) {
                    if (this.selectedMethod.accountregex) {
                        let re = new RegExp(helper.formatRegex(this.selectedMethod.accountregex));
                        if (!re.test(this.destination)) {
                            ++invalid;
                            this.invalid_text = this.$t('validations.merchant.account_number_format', {format: this.selectedMethod.placeholder_text});
                            console.log('Account number not matching regex');
                        }
                    } else if (this.destination.length < 6) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.merchant.account_number_invalid');
                        console.log('Invalid account number. Too short');
                    }
                } else {
                    ++invalid;
                    this.invalid_text = this.$t('validations.merchant.no_method');
                    console.log('No payment method selected');
                }
                if (invalid === 0) {
                    this.invalid_text = '';
                    console.log('Validation complete. All inputs valid');
                    return true;
                }
                return false;
            },
            currencyFormat(amount) {
                return currency.format(amount, this.order.currency_code);
            }
        },
        watch: {
            triggerLoadStatus() {
                this.spinner_status = this.triggerLoadStatus;
            }
        }
    }

</script>

<style scoped>

</style>
