<template>
    <div class="col-md-5">
        <div class="card border-0 ">
            <div class="card-header card-2">
                <p class="card-text text-muted mt-md-4 mb-2 space">{{$t('dashboard.merchant.order.your_order')}}</p>
                <hr class="my-2">
            </div>
            <div class="card-body pt-0">
                <div class="row justify-content-between small">
                    <div>
                        <div v-if="order.customer && order.customer.name">{{order.customer.name}}</div>
                        <div v-if="order.customer && order.customer.address">{{order.customer.address}}</div>
                        <div v-if="order.customer && order.customer.phone">{{order.customer.phone}}</div>
                        <div v-if="order.customer && order.customer.email">{{order.customer.email}}</div>
                    </div>
                </div>
                <hr class="my-2">
                <div v-for="item in order.items" class="row justify-content-between">
                    <div class="col-auto col-md-7">
                        <div class="media flex-column flex-sm-row"><br><br> <img v-if="item.item_logo" class="img-fluid" :src="item.item_logo" width="62" height="62" :alt="item.code">
                            <div class="media-body my-auto">
                                <div class="row ">
                                    <div class="col-auto">
                                        <p class="mb-0"><b>{{item.name}}</b></p><small class="text-muted">{{item.description}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" pl-0 flex-sm-col col-auto my-auto">
                        <p class="boxed-1">{{currencyFormat(item.unit_cost)}}</p>
                    </div>
                    <div class=" pl-0 flex-sm-col col-auto my-auto">
                        <p class="boxed-1">{{item.quantity}}</p>
                    </div>
                    <div class=" pl-0 flex-sm-col col-auto my-auto ">
                        <p><b>{{currencyFormat(item.sub_total)}}</b></p>
                    </div>
                </div>
                <hr class="my-2">
                <div class="row ">
                    <div class="col">
                        <div class="row justify-content-between">
                            <div class="col">
                                <p class="mb-1"><b>{{$t('dashboard.merchant.order.payment_fee')}}</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1"><b>{{currencyFormat(paymentCustomerFee)}}</b></p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <p><b>{{$t('dashboard.merchant.order.subtotal')}}</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1"><b>{{currencyFormat(order.total_amount)}}</b></p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <p><b>{{$t('dashboard.merchant.order.total')}}</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1"><b>{{currencyFormat(parseFloat(order.total_amount) + parseFloat(paymentCustomerFee))}} <span v-if="order.system_currency_code != order.currency_code">({{ currencyFormat(parseFloat(order.system_total_amount) + parseFloat(customerFee), order.system_currency_code) }})</span></b></p>
                            </div>
                        </div>
                        <hr class="my-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {EventBus} from "../../event-bus";
    import {currency} from "../../helpers/currency";

    export default {
        name: "OrderSummary",
        props: [
            'order'
        ],
        data() {
            return {
                customerFee: 0,
                paymentCustomerFee: 0,
            }
        },
        mounted() {
            EventBus.$on('customer-fee', function (data) {
                this.customerFee = data.customerFee;
                this.paymentCustomerFee = data.paymentCustomerFee;
            }.bind(this));
        },
        methods: {
            currencyFormat(amount, currencyCode = this.order.currency_code) {
                return currency.format(amount, currencyCode);
            }
        }
    }
</script>

<style scoped>

</style>
