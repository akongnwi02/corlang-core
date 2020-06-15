<template>
    <mdb-modal @close="$emit('closed')" class="text-center">
        <mdb-modal-header>
            <mdb-modal-title>{{ $t('dashboard.pages.general.summary') }}</mdb-modal-title>
        </mdb-modal-header>
        <mdb-modal-body>
            <mdb-row>
                <mdb-col class="col-sm-3">
                    <img :src="transaction.service_logo" :alt="$t('dashboard.pages.general.logo')">
                </mdb-col>
                <mdb-col class="col-sm-9">
                    <strong>{{transaction.service}}</strong>
                    <!--<mdb-card-text>{{ service.description }}</mdb-card-text>-->
                </mdb-col>
            </mdb-row>
            <hr>
            <mdb-row class="justify-content-center">

                <table class="table table-sm dataTable table-borderless text-sm-center">
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.code') }}
                        </th>
                        <td>
                            {{ transaction.code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.destination') }}
                        </th>
                        <td>
                            {{ transaction.destination }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.agent') }}
                        </th>
                        <td>
                            {{ transaction.user }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.service') }}
                        </th>
                        <td>
                            {{ transaction.service }}
                        </td>
                    </tr>
                    <tr v-if="transaction.items">
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.items') }}
                        </th>
                        <td>
                            {{ transaction.items }}
                        </td>
                    </tr>
                    <tr v-if="transaction.asset">
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.asset') }}
                        </th>
                        <td>
                            {{ transaction.asset }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.amount') }}
                        </th>
                        <td>
                            {{ currencyFormat(transaction.amount) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.fee') }}
                        </th>
                        <td>
                            {{ currencyFormat(transaction.total_customer_fee) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.total') }}
                        </th>
                        <td>
                            {{ currencyFormat(transaction.total_customer_amount) }}
                        </td>
                    </tr>
                    <tr v-if="transaction.completed_at">
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.completed_at') }}
                        </th>
                        <td>
                            {{ transaction.completed_at }}
                        </td>
                    </tr>                    <tr>
                        <th>
                            {{ $t('dashboard.pages.transactions.transaction.modal.status') }}
                        </th>
                        <td>
                            {{ $t('dashboard.pages.transactions.table.status.'+transaction.status) }}
                        </td>
                    </tr>
                </table>
            </mdb-row>
        </mdb-modal-body>
        <mdb-modal-footer>
            <mdb-btn size="sm" color="secondary" @click.native="$emit('closed')">{{ $t('dashboard.pages.general.close') }}</mdb-btn>
        </mdb-modal-footer>
    </mdb-modal>
</template>

<script>
    import { currency} from "../../helpers/currency";
    import {mdbModalFooter, mdbModal, mdbBtn, mdbCol, mdbRow, mdbInput, mdbModalBody, mdbModalHeader, mdbModalTitle} from 'mdbvue';

    export default {
        name: "Transaction",
        props: [
            'transaction',
        ],
        components: {
            mdbModalFooter,
            mdbModal,
            mdbBtn,
            mdbCol,
            mdbInput,
            mdbModalBody,
            mdbModalHeader,
            mdbModalTitle,
            mdbRow
        },
        methods: {
            currencyFormat(amount) {
                return currency.format(amount, this.transaction.currency_code)
            }
        }
    }
</script>
