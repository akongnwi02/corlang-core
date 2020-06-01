export const Reset = {
    activated() {
        this.$store.commit('setQuoteLoadStatus', 0);
        this.$store.commit('setPaymentStatus', 0);
        this.$store.commit('setTransactionLoadStatus', 0);
    },
};
