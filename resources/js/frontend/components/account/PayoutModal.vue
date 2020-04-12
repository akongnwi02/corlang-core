<template>
    <mdb-modal @close="$emit('closed')" class="text-center">
        <mdb-modal-header>
            <mdb-modal-title>{{ $t('dashboard.pages.account.request_payout') }}</mdb-modal-title>
            <br>
            <div class="card-text text-danger"> {{ invalid_text }}</div>
        </mdb-modal-header>
        <mdb-modal-body>
            <div class="row">
                <mdb-col class="col-sm-6">
                    <mdb-input key="amount"
                               :placeholder="$t('dashboard.pages.general.amount') + ' ' + account.currency_code"
                               v-model="amount"></mdb-input>
                </mdb-col>
                <mdb-col class="col-sm-6">
                    <mdb-input key="name"
                               :placeholder="$t('dashboard.pages.account.name')"
                               v-model="name"></mdb-input>
                </mdb-col>
                <mdb-col class="col-sm-6">
                    <label for="paymentMethod"><strong>{{ $t('dashboard.pages.account.payout_method') }}</strong></label>
                    <select v-model="selectedMethod" class="custom-select" id="paymentMethod" required>
                        <option v-for="method in methods" :value="method">
                            {{ method.name }}
                        </option>
                    </select>
                </mdb-col>
                <mdb-col class="col-sm-6">
                    <mdb-input v-if="!selectedMethod.is_default" key="amount"
                               :placeholder="$t('dashboard.pages.general.account')"
                               v-model="paymentaccount"></mdb-input>
                </mdb-col>
            </div>
        </mdb-modal-body>
        <mdb-modal-footer>
            <mdb-btn size="sm" color="secondary" @click.native="$emit('closed')">{{ $t('dashboard.pages.general.close') }}
            </mdb-btn>
            <mdb-btn size="sm" color="primary" @click.native="confirm()">{{ $t('dashboard.pages.general.confirm') }}
            </mdb-btn>
        </mdb-modal-footer>
    </mdb-modal>
</template>

<script>
    import {BUSINESS_CONFIG} from "../../config/business";

    export default {
        name: "PayoutModal",
        props: [
            'account',
        ],
        data() {
            return {
                invalid_text: '',
                paymentaccount: '',
                amount: 0,
                name: '',
                selectedMethod: {}
            }
        },
        computed: {
            methods() {
                return this.$store.getters.getConfiguration.methods
            }
        },
        mounted() {
            this.selectedMethod = this.methods[0];
            this.amount = this.account.balance;
        },
        methods: {
            confirm() {
                if (this.validate()) {
                    this.$emit('payout', {
                        amount: this.amount,
                        paymentaccount: this.paymentaccount,
                        name: this.name,
                        selectedMethod: this.selectedMethod
                    })
                }
            },
            validate() {
                let invalid = 0;

                if (!BUSINESS_CONFIG.APP_REGEX_AMOUNT.test(this.amount)) {
                    ++invalid;
                    this.invalid_text = this.$t('validations.account.invalid_amount');
                    console.log('Balance is invalid');
                }
                if (BUSINESS_CONFIG.APP_REGEX_AMOUNT.test(this.amount)) {
                    if (this.amount > this.account.balance) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.account.insufficient_balance');
                        console.log('Balance is insufficient');
                    }
                }
                if (this.paymentaccount.length < 7) {
                    if (!this.selectedMethod.is_default) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.account.account_number');
                        console.log('Invalid account number entered. Too short');
                    }
                }

                if (invalid === 0) {
                    this.invalid_text = '';
                    return true
                }
                return false
            }
        }
    }
</script>

<style scoped>

</style>
