<template>
    <mdb-modal scrollable centered fullHeight elegant @close="$emit('closed')" class="text-center">
        <mdb-modal-header>
            <mdb-modal-title>{{ $t('dashboard.pages.account.request_payout') }}</mdb-modal-title>
            <br>
            <div class="card-text text-danger"> {{ invalid_text }}</div>
        </mdb-modal-header>
        <mdb-modal-body>
            <div class="row">
                <divl class="col-lg-6">
                    <label for="paymentMethod"><strong>{{ $t('dashboard.pages.account.payout_method') }}</strong></label>
                    <select v-model="selectedMethod" class="custom-select" id="paymentMethod" required>
                        <option v-for="method in methods" :value="method">
                            {{ method.name }}
                        </option>
                    </select>
                </divl>
                <div class="col-lg-6">
                    <mdb-input key="amount"
                               :label="$t('dashboard.pages.general.amount') + ' ' + account.currency_code"
                               v-model="amount"></mdb-input>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <mdb-input key="name"
                               :label="$t('dashboard.pages.account.name')"
                               v-model="name"></mdb-input>
                </div>
                <div class="col-lg-6">
                    <mdb-input key="amount"
                               :label="$t('dashboard.pages.general.account')"
                               v-model="paymentaccount"></mdb-input>
                </div>
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
    import {mdbModalFooter, mdbModal, mdbBtn, mdbCol, mdbInput, mdbModalBody, mdbModalHeader, mdbModalTitle} from 'mdbvue';

    export default {
        name: "PayoutModal",
        props: [
            'account',
        ],
        components: {
            mdbModalFooter,
            mdbModal,
            mdbBtn,
            mdbCol,
            mdbInput,
            mdbModalBody,
            mdbModalHeader,
            mdbModalTitle
        },
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
                return this.$store.getters.getConfiguration.payout_methods
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
                    console.log('Amount is invalid');
                }

                if (this.paymentaccount.length < 7) {
                    if (! this.selectedMethod.is_default) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.account.account_number');
                        console.log('Invalid account number entered. Too short');
                    }
                }

                if (this.name.length < 4) {
                    if (! this.selectedMethod.is_default) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.account.account_name');
                        console.log('Invalid account name entered. Too short');
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
