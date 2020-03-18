import {BUSINESS_CONFIG} from "../../config/business";

export const PusherNotification = {
    methods: {
        waitForNotification(uuid) {
            Echo.channel(uuid)
                .listen(BUSINESS_CONFIG.PUSHER_APP_TRANSACTION_EVENT, function(data) {
                    if (data.transaction.status == BUSINESS_CONFIG.TRANSACTION_SUCCESSFUL) {
                        this.$store.commit('setPaymentStatus', 2);
                        console.log('transaction successful', data.transaction);
                        this.$buefy.toast.open({
                            message: this.$t('notifications.successful'),
                            type: 'is-success'
                        });

                    } else {
                        this.$store.commit('setPaymentStatus', 3);
                        console.log('transaction failed', data.transaction);
                        let error = data.transaction.error;
                        this.$buefy.toast.open({
                            message: this.$t('validations.general.business.' + error),
                            type: 'is-danger'
                        });
                    }
                }.bind(this));
        },
    },
};
