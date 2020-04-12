<template>
    <div class="justify-content-center card-body">
        <div class="cols-sm-12 col-lg-12">
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div v-if="!accountIsEmpty" class="text-value-lg"><h4><strong>{{account.code}}</strong></h4></div>
                            <div>{{$t('dashboard.pages.account.account_number')}}</div>
                            <small class="text-muted">{{ $t('dashboard.pages.account.account_number_help')}}</small>
                        </div>
                    </div>
                </div><!--col-->
                <div class="col-sm-4 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div v-if="!accountIsEmpty" class="text-value-lg"><h4><strong>{{ currency(account.balance)}}</strong></h4></div>
                            <div>{{ $t('dashboard.pages.account.account_balance')}}</div>
                            <small class="text-muted">{{ $t('dashboard.pages.account.account_balance_help')}}</small>
                        </div>
                    </div>
                </div><!--col-->
                <div class="col-sm-4 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div v-if="!accountIsEmpty" class="btn-group float-right" @click="showModal" >
                                <span style="cursor: pointer" class="fa fa-arrow-circle-down"></span>
                            </div>
                            <div v-if="!accountIsEmpty" class="text-value-lg"><h4><strong>{{currency(account.commission)}}</strong></h4></div>
                            <div>{{ $t('dashboard.pages.account.commission_balance')}}</div>
                            <small class="text-muted">{{ $t('dashboard.pages.account.commission_balance_help')}}</small>
                        </div>
                    </div>
                </div><!--col-->
            </div>
        </div>
        <payout-modal v-on:payout="requestPayout" v-on:closed="show_payout_modal=false" v-show="show_payout_modal==true" :account="account"></payout-modal>
    </div><!--card-body-->
</template>

<script>
    import {currency} from "../helpers/currency";
    import PayoutModal from "../components/account/PayoutModal";

    export default {
        name: "Account",
        components: {PayoutModal},
        data() {
            return {
                show_payout_modal: false,
            }
        },

        activated() {
            this.$store.dispatch('getAccount');
        },
        computed: {
            account() {
                return this.$store.getters.getAccount;
            },
            accountLoadStatus() {
                return this.$store.getters.getAccountLoadStatus;
            },
            accountIsEmpty() {
                return Object.keys(this.account).length === 0;
            }
        },
        methods: {
            currency(amount) {
                return currency.format(amount, this.account.currency_code);
            },
            showModal() {
                this.show_payout_modal = true;
            },
            requestPayout(payout) {
                this.show_payout_modal = false;

                console.log('requesting payout', payout);
                this.$store.dispatch('requestPayout', {
                    currency_code: this.account.currency_code,
                    paymentmethod_code: payout.selectedMethod.code,
                    amount: payout.amount,
                    name: payout.name,
                    account: payout.paymentaccount,
                });

            }
        }
    }
</script>

<style scoped>

</style>
