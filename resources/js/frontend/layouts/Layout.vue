<template>
    <mdb-container>
        <mdb-tab tabs color="primary" justify key="page">
            <mdb-tab-item key="purchase-tab" :active="page=='purchase'" @click.native.prevent="page='purchase'">
                <mdb-icon icon="shopping-bag" class="ml-2"/> {{ $t(`dashboard.pages.titles.purchase`) }}
            </mdb-tab-item>

            <mdb-tab-item key="transactions-tab" :active="page=='transactions'" @click.native.prevent="page='transactions'">
                <mdb-icon icon="list" class="ml-2"/> {{ $t(`dashboard.pages.titles.transactions`) }}
            </mdb-tab-item>

            <mdb-tab-item key="account-tab" :active="page=='account'" @click.native.prevent="page='account'">
                <mdb-icon icon="inbox" class="ml-2"/> {{ $t(`dashboard.pages.titles.account`) }}
            </mdb-tab-item>
        </mdb-tab>
        <mdb-tab-content key="page-content">
            <mdb-tab-pane key="purchase-content" class="active" v-if="page=='purchase'">
                <keep-alive>
                    <purchase></purchase>
                </keep-alive>
            </mdb-tab-pane>
            <mdb-tab-pane class="fade" key="transactions-content" v-if="page=='transactions'">
                <keep-alive>
                    <transactions></transactions>
                </keep-alive>
            </mdb-tab-pane>
            <mdb-tab-pane class="fade" key="account-content" v-if="page=='account'">
                <keep-alive>
                    <account></account>
                </keep-alive>
            </mdb-tab-pane>
        </mdb-tab-content>
        <loader></loader>
    </mdb-container>

</template>

<script>
    import { ChangeLanguage }from '../mixins/local/ChangeLanguage'

    import Purchase from '../pages/Purchase';
    import Transactions from '../pages/Transactions';
    import Loader from "../components/global/Loader";
    import Account from "../pages/Account";

    export default {
        name: "Layout",
        mixins: [
            ChangeLanguage,
        ],
        components: {
            Account,
            Loader,
            Purchase,
            Transactions,
        },
        data() {
            return{
                page: 'purchase',
            }
        },
        // created() {
        //     this.$store.dispatch('loadUser')
        // },
    }
</script>

