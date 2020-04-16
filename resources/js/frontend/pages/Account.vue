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
        <br/>
        <div class="row">
            <div class="col-sm-5">
                <h4 class="mb-0">
                    {{ $t('dashboard.pages.account.table.entriesTitle') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                <button @click="refresh" class="btn btn-primary btn-sm float-right" type="button">
                    <span class="fa fa-sync" role="status" aria-hidden="true"></span>
                    {{ $t('dashboard.pages.general.refresh') }}
                </button>
            </div><!--col-->
        </div><!--row-->
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ $t('dashboard.pages.account.table.header.code') }}</th>
                                <th>{{ $t('dashboard.pages.account.table.header.amount') }}</th>
                                <th>{{ $t('dashboard.pages.account.table.header.method') }}</th>
                                <th>{{ $t('dashboard.pages.account.table.header.account_number') }}</th>
                                <th>{{ $t('dashboard.pages.account.table.header.account_name') }}</th>
                                <th>{{ $t('dashboard.pages.account.table.header.user') }}</th>
                                <th>{{ $t('dashboard.pages.account.table.header.date') }}</th>
                                <th>{{ $t('dashboard.pages.account.table.header.status') }}</th>
                                <th>{{ $t('dashboard.pages.account.table.header.decision_at') }}</th>

                                <th>{{ $t('dashboard.pages.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="payout in payouts">
                            <td>{{ payout.code }}</td>
                            <td>{{ currency(payout.amount) }}</td>
                            <td>{{ payout.method }}</td>
                            <td>{{ payout.account_number }}</td>
                            <td>{{ payout.account_name }}</td>
                            <td>{{ payout.user }}</td>
                            <td>{{ payout.date }}</td>
                            <td>{{ $t('dashboard.pages.account.table.status.'+payout.status) }}</td>
                            <td>{{ payout.decision_at }}</td>
                            <td>
                                <div v-if="payout.status=='pending'" @click="cancelPayout(payout.uuid)" class="btn-group" role="group" :aria-label="$t('dashboard.pages.account.table.actions.action')">
                                    <span data-toggle="tooltip" data-placement="top" :title="$t('dashboard.pages.account.table.actions.cancel')" class="btn btn-sm btn-danger"><i class="fas fa-ban"></i></span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <spinner :status="spinner_status"></spinner>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <!--<div class="float-left">-->
                    <!--{!! $payouts->total() !!} {{ trans_choice('labels.backend.account.deposit.tabs.content.movements.table.total', $payouts->total()) }}-->
                <!--</div>-->
            </div><!--col-->

            <div class="col-5">
                <!--<div class="float-right">-->
                    <!--{!! $payouts->render() !!}-->
                <!--</div>-->
            </div><!--col-->
        </div><!--row-->
        <payout-modal v-on:payout="requestPayout" v-on:closed="show_payout_modal=false" v-show="show_payout_modal==true" :account="account"></payout-modal>
    </div><!--card-body-->
</template>

<script>
    import {currency} from "../helpers/currency";
    import PayoutModal from "../components/account/PayoutModal";
    import Spinner from '../components/global/Spinner';

    export default {
        name: "Account",
        components: {
            PayoutModal,
            Spinner
        },
        data() {
            return {
                show_payout_modal: false,
                spinner_status: false,
            }
        },
        mounted() {
            this.refresh();
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
            },
            payouts() {
                return this.$store.getters.getPayouts;
            },
            payoutsLoadStatus() {
                return this.$store.getters.getPayoutsLoadStatus;
            },
            payoutStatus() {
                return this.$store.getters.getPayoutStatus;
            },
            cancelPayoutStatus() {
                return this.$store.getters.getCancelPayoutStatus;
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
            },
            refresh() {
                this.$store.dispatch('loadPayouts');
            },
            cancelPayout(uuid) {
                this.$store.dispatch('cancelPayout', uuid);
            },
        },
        watch: {
            payoutsLoadStatus() {
                if (this.payoutsLoadStatus == 2) {
                    this.$buefy.toast.open({
                        message: this.$t('notifications.payouts_loaded'),
                        type: 'is-success'
                    });
                }
                this.spinner_status = this.payoutsLoadStatus;
            },
            payoutStatus() {
                if (this.payoutStatus == 2) {
                    this.$store.dispatch('getAccount');
                    this.refresh();
                }
                this.spinner_status = this.payoutStatus;
            },
            cancelPayoutStatus() {
                if (this.cancelPayoutStatus == 2) {
                    this.$store.dispatch('getAccount');
                    this.refresh();
                }
                this.spinner_status = this.cancelPayoutStatus;
            },
            accountLoadStatus() {
                this.spinner_status = this.accountLoadStatus;
            },
        }
    }
</script>

<style scoped>

</style>
