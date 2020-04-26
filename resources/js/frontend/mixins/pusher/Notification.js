import {BUSINESS_CONFIG} from "../../config/business";

export const PusherNotification = {
    methods: {
        waitForNotification(uuid) {
            Echo.channel(uuid)
                .listen(BUSINESS_CONFIG.PUSHER_APP_TRANSACTION_EVENT, function(transaction) {
                    console.log('callback notification received', transaction);
                    if (transaction.status == BUSINESS_CONFIG.TRANSACTION_SUCCESSFUL) {
                        this.$store.commit('setPaymentStatus', 2);
                        this.$buefy.toast.open({
                            message: this.$t('notifications.successful'),
                            type: 'is-success'
                        });

                    } else {
                        this.$store.commit('setPaymentStatus', 3);
                        console.log('transaction failed', transaction);
                        this.$buefy.toast.open({
                            message: this.$t('exceptions.' + transaction.error_code),
                            type: 'is-danger'
                        });
                    }
                }.bind(this));
        },
    },
};
