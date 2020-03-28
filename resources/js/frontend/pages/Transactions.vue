<template>
    <div class="text-center card-body" @keyup.enter="requestQuote">
        <button @click="refresh" class="btn btn-primary btn-sm float-left" type="button">
            <span class="fa fa-sync" role="status" aria-hidden="true"></span>
            {{ $t('dashboard.pages.general.refresh') }}
        </button>

        <mdb-datatable
            :data="data"
            striped
            bordered
            :responsive="true"
            :sorting="false"

            arrows
            start="<<"
            end=">>"
            next=">"
            previous="<"
            :tfoot="false"
            :searchPlaceholder="$t('dashboard.pages.general.search')"
            :entriesTitle="$t('dashboard.pages.transactions.table.entriesTitle')"
            :showingText="$t('dashboard.pages.transactions.table.showingText')"
            :noFoundMessage="$t('dashboard.pages.transactions.table.noFoundMessage')"
        >
        </mdb-datatable>
        <spinner :status="transactionsLoadStatus"></spinner>
    </div>

</template>

<script>

    import Spinner from "../components/global/Spinner";
    import {currency} from "../helpers/currency";

    export default {
        components: {Spinner},
        mixins: [],
        data() {
            return {
                data: {
                    columns: [
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.code'),
                            field: 'code',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.destination'),
                            field: 'destination',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.items'),
                            field: 'items',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.fee'),
                            field: 'fee',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.total'),
                            field: 'total',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.service'),
                            field: 'service',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.paymentmethod'),
                            field: 'paymentmethod',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.status'),
                            field: 'status',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.asset'),
                            field: 'asset',
                            sort: 'desc'
                        },
                        {
                            label: this.$t('dashboard.pages.transactions.table.header.completed_at'),
                            field: 'completed_at',
                            sort: 'desc'
                        },
                    ],
                    rows: []
                }
            }
        },
        computed: {
            transactionsLoadStatus() {
                return this.$store.getters.getTransactionsLoadStatus;
            },
            transactions() {
                return this.$store.getters.getTransactions;
            },
        },
        mounted() {
            this.refresh();
        },
        methods: {
            refresh() {
                this.$store.dispatch('loadTransactions');
            },
        },
        watch: {
            transactionsLoadStatus() {
                if (this.transactionsLoadStatus == 2) {
                    let transaction;
                    // using this hack to reset the array
                    this.data.rows.splice(0, this.data.rows.length);
                    for (transaction of this.transactions) {
                        let obj = {};
                        obj.code = transaction.code;
                        obj.items = transaction.items;
                        obj.destination = transaction.destination;
                        obj.fee = currency.format(transaction.total_customer_fee, transaction.currency_code);
                        obj.total = currency.format(transaction.total_customer_amount, transaction.currency_code);
                        obj.service = transaction.service;
                        obj.paymentmethod = transaction.paymentmethod+' - '+transaction.paymentaccount;
                        obj.status = this.$t('dashboard.pages.transactions.table.status.'+transaction.status);
                        obj.asset = transaction.asset;
                        obj.completed_at = transaction.completed_at;
                        this.data.rows.push(obj);
                    }
                }
            }
        }
    }
</script>

<style>
    .custom-select.custom-select-sm.form-control.form-control-sm {
        display: none;
    }
</style>
