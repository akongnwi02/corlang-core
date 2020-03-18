<template>
    <mdb-modal :show="showModal" @close="$emit('closed')" class="text-center">
        <mdb-modal-header>
            <mdb-modal-title>{{ $t('dashboard.pages.general.summary') }}</mdb-modal-title>
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
                        {{ $t('dashboard.pages.tabs.content.electricity.meter_code') }}:
                        <strong>{{ quote.destination }}</strong>
                    </li>
                    <li>
                        {{ $t('dashboard.pages.general.amount')}}:
                        <strong>{{ currencyFormat(quote.amount) }}</strong>
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
                        <strong>{{ currencyFormat(quote.customer_fee) }}</strong>
                    </li>
                    <li>
                        {{ $t('dashboard.pages.general.total')}}:
                        <strong>{{ currencyFormat(quote.total) }}</strong>
                    </li>
                </ul>
            </mdb-row>
        </mdb-modal-body>
        <mdb-modal-footer>
            <mdb-btn size="sm" color="secondary" @click.native="$emit('closed')">{{ $t('dashboard.pages.general.close') }}</mdb-btn>
            <mdb-btn size="sm" color="primary" @click.native="confirm()">{{ $t('dashboard.pages.general.confirm') }}</mdb-btn>
        </mdb-modal-footer>
    </mdb-modal>
</template>

<script>
    import { currency} from "../../helpers/currency";

    export default {
        name: "QuoteModal",
        props: [
            'showModal',
            'quote',
            'service',
        ],
        methods: {
            currencyFormat(amount) {
                return currency.format(amount, this.quote.currency)
            },
            confirm() {
                this.$emit('confirmed');
            },
        }
    }
</script>
