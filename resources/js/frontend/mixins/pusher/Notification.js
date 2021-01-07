import {BUSINESS_CONFIG} from "../../config/business";

export const PusherNotification = {
    methods: {
        waitForNotification(uuid) {
            Echo.channel(uuid)
                .listen(BUSINESS_CONFIG.PUSHER_APP_TRANSACTION_EVENT, function(transaction) {
                    console.log('callback received. Transaction status:', transaction.status);
                    if (transaction.status == BUSINESS_CONFIG.TRANSACTION_SUCCESSFUL) {
                        this.$store.commit('setPaymentStatus', 2);
                        this.$store.dispatch('getAccount');
                        this.$store.dispatch('loadTransactions');
                        this.$buefy.toast.open({
                            message: this.$t('notifications.successful'),
                            type: 'is-success',
                            duration: 7000
                        });
                        if (transaction.category_code == BUSINESS_CONFIG.CATEGORY_PREPAID_BILLS_CODE) {
                            this.$store.dispatch('loadTransaction', transaction.uuid);
                        }
                    } else {
                        this.$store.commit('setPaymentStatus', 3);
                        this.$buefy.toast.open({
                            message: this.$t('exceptions.' + transaction.error_code),
                            type: 'is-danger',
                            duration: 7000
                        });
                    }
                }.bind(this));
        },
    },
};
