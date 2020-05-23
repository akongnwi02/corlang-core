<template>
    <mdb-modal @close="$emit('closed')" class="text-center">
        <mdb-modal-header>
            <mdb-modal-title>{{ $t('dashboard.pages.account.topup_account') }}</mdb-modal-title>
            <br>
            <div class="card-text text-danger"> {{ invalid_text }}</div>
        </mdb-modal-header>
        <mdb-modal-body>
            <div class="row">
                <mdb-col class="col-sm-6">
                    <label for="paymentMethod"><strong>{{ $t('dashboard.pages.account.topup_method') }}</strong></label>
                    <select v-model="selectedMethod" class="custom-select" id="paymentMethod" required>
                        <option v-for="method in methods" :value="method">
                            {{ method.name }}
                        </option>
                    </select>
                </mdb-col>
                <mdb-col class="col-sm-6">
                    <label v-if="!topupAccount(selectedMethod)" class="alert alert-danger">{{ $t('validations.account.topup_account_not_configured') }}</label>
                    <mdb-input v-if="topupAccount(selectedMethod) && accountLoadStatus==2" id="account" key="account" :label="$t('dashboard.pages.general.account')" :value="topupAccount(selectedMethod)" disabled></mdb-input>
                </mdb-col>
            </div>
            <div class="row">
                <mdb-col class="col-sm-6">
                    <mdb-input key="amount"
                               :label="$t('dashboard.pages.general.amount') +' '+ currency.code"
                               v-model="amount"></mdb-input>
                </mdb-col>
                <mdb-col v-if ="selectedMethod.service" class="col-sm-6">
                    <mdb-input v-if="selectedMethod.service.requires_auth" :key="selectedMethod.service.auth_type"
                               :label="$t('dashboard.pages.general.' + selectedMethod.service.auth_type)"
                               v-model="auth_payload"></mdb-input>
                </mdb-col>
            </div>
            <div>
                <small>{{ $i18n.locale == 'en' ? selectedMethod.description_en : selectedMethod.description_fr }}</small>
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
        name: "TopupModal",
        data() {
            return {
                invalid_text: '',
                amount: 0,
                auth_payload: '',
                selectedMethod: {}
            }
        },
        mounted() {
            this.selectedMethod = this.methods[0]
        },
        computed: {
            methods() {
                return this.$store.getters.getConfiguration.payout_methods.filter(obj => {
                    return obj.is_realtime == true && obj.is_default == false
                });
            },
            topupAccounts() {
                return this.$store.getters.getAccount.topup_accounts;
            },
            accountLoadStatus() {
                return this.$store.getters.getAccountLoadStatus;
            },
            currency() {
                return this.$store.getters.getConfiguration.currency;
            }
        },
        methods: {
            confirm() {
                if (this.validate()) {
                    this.$emit('topup', {
                        amount: this.amount,
                        paymentaccount: this.topupAccount(this.selectedMethod),
                        auth_payload: this.auth_payload,
                        selectedMethod: this.selectedMethod,
                        currency_code: this.currency.code,
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

                if (! this.topupAccount(this.selectedMethod)) {
                    ++invalid;
                    this.invalid_text = this.$t('validations.account.account_number');
                    console.log('Account not configured');
                }

                if (this.auth_payload.length < 3) {
                    if (this.selectedMethod.service.requires_auth) {
                        ++invalid;
                        this.invalid_text = this.$t('validations.purchase.' + this.selectedMethod.service.auth_type);

                        console.log('Invalid auth_payload entered. Too short');
                    }
                }

                if (invalid === 0) {
                    this.invalid_text = '';
                    return true
                }
                return false
            },
            topupAccount(method) {
                if (this.accountLoadStatus == 2) {
                    let myAccount = this.topupAccounts.filter(obj => {
                        return obj.paymentmethod_id == method.uuid;
                    })[0];

                    if (myAccount) {
                        return myAccount.account;
                    }
                    return null;
                }
                return null
            }
        }
    }
</script>

<style scoped>

</style>
