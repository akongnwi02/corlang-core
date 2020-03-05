<template>
    <button @click="$emit('clicked')" class="btn btn-primary btn-sm float-right" type="button" :disabled="status==1">
        <span v-bind:class="classObject" role="status" aria-hidden="true"></span>
         {{ buttonText }}
    </button>
</template>

<script>
    export default {
        name: "SearchButton",
        props: ['status'],
        computed: {
            classObject: function(){
                return{
                    active: this.status != 1,
                    'spinner-border spinner-border-sm': this.status==1,
                }
            },
            buttonText() {
                return this.status == 2 ? this.$t(`dashboard.pages.tabs.content.electricity.loading`) : this.$t(`dashboard.pages.tabs.content.electricity.next`);
            }
        }
    }
</script>

<style scoped>

</style>
