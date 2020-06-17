<template>
    <mdb-modal scrollable centered fullHeight elegant @close="$emit('closed')" class="text-center">
        <mdb-modal-header>
            <mdb-modal-title>{{ $t('dashboard.pages.general.summary') }}</mdb-modal-title>
        </mdb-modal-header>
        <mdb-modal-body>
            <mdb-row>
                <mdb-col class="col-sm-3">
                    <img :src="service.logo_url" :alt="$t('dashboard.pages.general.logo')">
                </mdb-col>
                <mdb-col class="col-sm-9">
                    <strong>{{ service.name }}</strong>
                    <!--<mdb-card-text>{{ service.description }}</mdb-card-text>-->
                </mdb-col>
            </mdb-row>
            <hr>
            <mdb-row class="justify-content-center">
                <label v-if="quote.bill_is_late" class="alert alert-warning">{{ $t('notifications.late_bill') }}</label>
                <table class="table table-sm dataTable table-borderless text-sm-center">
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.tabs.content.electricity.contract_number') }}
                        </th>
                        <td>
                            {{ quote.contract_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.tabs.content.electricity.bill_number') }}
                        </th>
                        <td>
                            {{ quote.bill_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.tabs.content.electricity.bill_due_date') }}
                        </th>
                        <td>
                            {{ quote.bill_due_date }}
                        </td>
                    </tr>
                    <tr v-if="quote.name">
                        <th>
                            {{ $t('dashboard.pages.general.customer.name')}}
                        </th>
                        <td>
                            {{ quote.name }}
                        </td>
                    </tr>
                    <tr v-if="quote.address">
                        <th>
                            {{ $t('dashboard.pages.general.customer.address')}}
                        </th>
                        <td>
                            {{ quote.address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.general.amount')}}
                        </th>
                        <td>
                            {{ currencyFormat(quote.amount) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.general.fee')}}
                        </th>
                        <td>
                            {{ currencyFormat(quote.fee) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ $t('dashboard.pages.general.total') }}
                        </th>
                        <td>
                            {{ currencyFormat(quote.amount + quote.fee) }}
                        </td>
                    </tr>
                </table>
            </mdb-row>
        </mdb-modal-body>
        <mdb-modal-footer>
            <mdb-btn size="sm" color="secondary" @click.native="$emit('closed')">{{ $t('dashboard.pages.general.close') }}</mdb-btn>
            <mdb-btn size="sm" color="primary" @click.native="confirm()">{{ $t('dashboard.pages.general.confirm') }}</mdb-btn>
        </mdb-modal-footer>
    </mdb-modal>
</template>

<script>
    import { currency } from "../../helpers/currency";
    import {mdbModalFooter, mdbModal, mdbBtn, mdbCol, mdbRow, mdbInput, mdbModalBody, mdbModalHeader, mdbModalTitle} from 'mdbvue';
    export default {
        name: "PostpaidBillQuoteModal",
        props: [
            'quote',
            'service',
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
                return currency.format(amount, this.quote.currency_code)
            },
            confirm() {
                this.$emit('confirmed');
            },
        }
    }
</script>

<style scoped>

</style>
