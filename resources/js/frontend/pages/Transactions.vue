<template>
    <div class="text-center card-body" @keyup.enter="requestQuote">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="mb-0">
                    {{ $t('dashboard.pages.transactions.table.entriesTitle') }}
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
                            <th>{{ $t('dashboard.pages.transactions.table.header.code') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.destination') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.items') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.fee') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.total') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.commission') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.service') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.asset') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.completed_at') }}</th>
                            <th>{{ $t('dashboard.pages.transactions.table.header.status') }}</th>

                            <th>{{ $t('dashboard.pages.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="transactionsLoadStatus==2" v-for="transaction in transactions">
                            <td>{{ transaction.code }}</td>
                            <td>{{ transaction.destination }}</td>
                            <td>{{ transaction.items }}</td>
                            <td>{{ currency(transaction.total_customer_fee, transaction.currency_code) }}</td>
                            <td>{{ currency(transaction.total_customer_amount, transaction.currency_code) }}</td>
                            <td>{{ currency(transaction.agent_commission, transaction.currency_code) }}</td>
                            <td>{{ transaction.service }}</td>
                            <td>{{ transaction.asset }}</td>
                            <td>{{ transaction.completed_at }}</td>
                            <td><span class="badge" :class="badge(transaction.status)">{{ $t('dashboard.pages.transactions.table.status.'+transaction.status) }}</span></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <span @click="view(transaction.uuid)" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-info" :title="$t('dashboard.hover.view')"><i class="fas fa-eye"></i></span>
                                    <span @click="execute(transaction.uuid)" v-if="transaction.status == 'created'" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-success" :title="$t('dashboard.hover.execute')"><i class="fas fa-play"></i></span>
                                    <span @click="remove(transaction.uuid)" v-if="transaction.status == 'created'" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-danger" :title="$t('dashboard.hover.delete')"><i class="fas fa-trash"></i></span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <spinner :status="spinner_status"></spinner>
                    <transaction-modal :transaction="transaction" v-on:closed="show_transaction_modal=false" v-if="show_transaction_modal"></transaction-modal>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{ transactions.length }} {{ $t('dashboard.pages.transactions.table.total') }}
                </div>
            </div><!--col-->

            <!--<div class="col-5">-->
                <!--<div class="float-right">-->
                    <!--<paginate-->
                        <!--:page-count="10"-->
                        <!--:page-range="3"-->
                        <!--:margin-pages="2"-->
                        <!--:click-handler="clickCallback"-->
                        <!--:prev-text="'«'"-->
                        <!--:next-text="'»'"-->
                        <!--:container-class="'pagination'"-->
                        <!--:page-class="'page-item'">-->
                    <!--</paginate>-->
                <!--</div>-->
            <!--</div>&lt;!&ndash;col&ndash;&gt;-->
        </div><!--row-->

    </div>

</template>

<script>

    import Spinner from "../components/global/Spinner";
    import {currency} from "../helpers/currency";
    import Paginate from 'vuejs-paginate';
    import {Navigation} from "../mixins/transaction/NavigateToTransactionDetails";
    import TransactionModal from "../components/global/TransactionModal"
    import {PusherNotification} from "../mixins/pusher/Notification";

    export default {
        components: {
            Paginate,
            Spinner,
            TransactionModal,
        },
        mixins: [Navigation, PusherNotification],
        data() {
            return {
                show_transaction_modal: false,
                spinner_status: 0
            }
        },
        computed: {
            transactionsLoadStatus() {
                return this.$store.getters.getTransactionsLoadStatus;
            },
            transactionLoadStatus() {
                return this.$store.getters.getTransactionLoadStatus;
            },
            transactions() {
                return this.$store.getters.getTransactions;
            },
            transaction() {
                return this.$store.getters.getTransaction;
            },
            deleteTransactionStatus() {
                return this.$store.getters.getDeleteTransactionStatus;
            }
        },
        mounted() {
            this.refresh();
        },
        methods: {
            refresh() {
                this.$store.dispatch('loadTransactions');
            },
            currency(amount, currency_code) {
                return currency.format(amount, currency_code)
            },
            view(uuid) {
                this.$store.dispatch('loadTransaction', uuid);
            },
            execute(uuid) {
                console.log('execute transaction');
                this.$store.dispatch('confirmPayment', {
                    id: uuid,
                });
                this.waitForNotification(uuid);
                console.log('waiting for callback notification on channel', uuid);
            },
            remove(uuid) {
                console.log('delete transaction');
                this.$store.dispatch('deleteTransaction', uuid);
            },
            // to be fixed
            clickCallback (pageNum) {
                console.log(pageNum)
            },
            badge(status) {
                switch (status) {
                    case 'success': return 'badge-success';
                    case 'failed': return 'badge-danger';
                    case 'errored': return 'badge-danger';
                    case 'processing': return 'badge-warning';
                    case 'reversed': return 'badge-dark';
                    case 'cancelled': return 'badge-dark';
                    default: return 'badge-light';
                }
            }
        },
        watch: {
            transactionsLoadStatus() {
                if (this.transactionsLoadStatus == 2) {
                    this.$buefy.toast.open({
                        message: this.$t('notifications.transactions_loaded'),
                        type: 'is-success'
                    });
                }
                this.spinner_status = this.transactionLoadStatus;
            },
            transactionLoadStatus() {
                if (this.transactionLoadStatus == 2) {
                    this.show_transaction_modal = true;
                }
                this.spinner_status = this.transactionLoadStatus;
            },
            deleteTransactionStatus() {
                if (this.deleteTransactionStatus == 2) {
                    this.refresh();
                }
                this.spinner_status = this.deleteTransactionStatus;
            },
        }
    }
</script>

<style>
    .custom-select.custom-select-sm.form-control.form-control-sm {
        display: none;
    }
</style>
