<template>
    <div class="row p-2 mt-3 justify-content-between mx-sm-2">
        <div class="col">
            <p class="text-muted space mb-0 shop"> {{$t('dashboard.merchant.shop')}}: <strong>{{order.company}}</strong></p>
            <p class="text-muted space mb-0 shop">{{$t('dashboard.merchant.address')}}: <strong>{{order.company_address}}</strong></p>
        </div>
        <div class="col">
            <div class="row justify-content-start ">
                <div class="col"> <a :href="order.company_website"><img class="irc_mi img-fluid cursor-pointer " :src="order.company_logo" width="70" height="70" :alt="order.company"></a> </div>
            </div>
        </div>
        <!--<div class="col-auto"> <img class="irc_mi img-fluid bell" src="https://i.imgur.com/uSHMClk.jpg" width="30" height="30"> </div>-->
    </div>
</template>

<script>
    export default {
        name: "ShopDetails",
        props: [
            'order'
        ]
    }
</script>

<style scoped>

</style>
