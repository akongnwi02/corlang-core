<template>
    <button @click="$emit('clicked')" class="btn btn-primary btn-sm float-right" type="button" :disabled="status==1">
        <span v-bind:class="classObject" role="status" aria-hidden="true"></span>
         {{ buttonText }}
    </button>
</template>

<script>
    export default {
        name: "SearchButton",
        data() {
            return {
                status: 0,
            }
        },
        computed: {
            classObject: function(){
                return{
                    active: this.status != 1,
                    'spinner-border spinner-border-sm': this.status==1,
                }
            },
            buttonText() {
                return this.status == 1 ? this.$t(`dashboard.pages.general.loading`) : this.$t(`dashboard.pages.general.next`);
            },
            quoteStatus() {
                return this.$store.getters.getQuoteLoadStatus;
            },
            paymentStatus() {
                return this.$store.getters.getPaymentStatus;
            }
        },
        watch: {
            quoteStatus() {
                this.status = this.quoteStatus;
            },
        }
    }
</script>

<style scoped>

</style>
