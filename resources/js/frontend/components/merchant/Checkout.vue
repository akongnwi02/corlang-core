<template>
    <div class="col-md-5">
        <div class="card border-0">
            <div class="card-header pb-0">
                <p class="card-text text-muted mt-4 space">{{$t('dashboard.merchant.payment.method')}}</p>
            </div>
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col">
                        <p class="text-muted mb-2"></p>
                        <Services v-on:selected="selectMethod" :services="methods"></Services>
                        <hr class="mt-0">
                    </div>
                </div>
                <div class="form-group"> <label for="account_number" class="small text-muted mb-1">{{$t('dashboard.merchant.payment.method')}}</label> <input type="text" class="form-control form-control-sm" name="account_number" id="account_number" :placeholder="$t(selectedMethod ? selectedMethod.placeholder_text : 'dashboard.merchant.payment.account_number')"> </div>
                <!--<div class="form-group"> <label for="NAME" class="small text-muted mb-1">NAME ON CARD</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="BBBootstrap Team"> </div>-->
                <!--<div class="form-group"> <label for="NAME" class="small text-muted mb-1">CARD NUMBER</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="4534 5555 5555 5555"> </div>-->
                <!--<div class="row no-gutters">-->
                    <!--<div class="col-sm-6 pr-sm-2">-->
                        <!--<div class="form-group"> <label for="NAME" class="small text-muted mb-1">VALID THROUGH</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="06/21"> </div>-->
                    <!--</div>-->
                    <!--<div class="col-sm-6">-->
                        <!--<div class="form-group"> <label for="NAME" class="small text-muted mb-1">CVC CODE</label> <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="183"> </div>-->
                    <!--</div>-->
                <!--</div>-->
                <div class="row mb-5 mt-4 ">
                    <div class="col-md-7 col-lg-6 mx-auto"><button type="button" class="btn btn-block btn-outline-primary btn-lg">{{$t('dashboard.merchant.payment.checkout')}}</button></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Services from "../services/Services";
    export default {
        name: "Checkout",
        components: {Services},
        props: [
            'order',
            'methods',
        ],
        data() {
            return {
                selectedMethod: null,
            }
        },
        methods: {
            selectMethod(method) {
                this.selectedMethod = method;
            },
        }
    }

</script>

<style scoped>

</style>
