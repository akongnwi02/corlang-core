<template>
    <mdb-row>
        <mdb-col md="3">
            <mdb-tab pills color="primary" class="nav-pills" vertical key="tabs">
                <mdb-tab-item class="mt-4" key="prepaidbills-tab" :active="tab=='prepaid.bill.search'" @click.native.prevent="gotoTab('prepaid.bill.search')">
                    <mdb-icon icon="plug" class="ml-2"/> {{ $t(`dashboard.pages.tabs.titles.prepaid`) }}
                </mdb-tab-item>
                <mdb-tab-item class="mt-4" key="postpaidbills-tab" :active="tab=='postpaid.bill.search'" @click.native.prevent="gotoTab('postpaid.bill.search')">
                    <mdb-icon icon="tint" class="ml-2"/> {{ $t(`dashboard.pages.tabs.titles.postpaid`) }}
                </mdb-tab-item>
                <mdb-tab-item class="mt-4" key="momo-tab" :active="tab=='momo'" @click.native.prevent="gotoTab('momo')">
                    <mdb-icon icon="mobile-alt" class="ml-2"/> {{ $t(`dashboard.pages.tabs.titles.momo`) }}
                </mdb-tab-item>
                <!--<mdb-tab-item class="mt-4" key="recharge-tab" :active="tab=='airtime'" @click.native.prevent="gotoTab('airtime')">-->
                    <!--<mdb-icon icon="address-card" class="ml-2"/>  {{ $t(`dashboard.pages.tabs.titles.airtime`) }}-->
                <!--</mdb-tab-item>-->
            </mdb-tab>
        </mdb-col>
        <mdb-col md="9">
            <mdb-tab-content vertical key="tabs-content">
                <mdb-tab-pane class="active" :key="tab + '.content'">
                    <keep-alive>
                        <router-view></router-view>
                    </keep-alive>
                </mdb-tab-pane>
            </mdb-tab-content>
        </mdb-col>
    </mdb-row>
</template>

<script>
    import Search from '../components/prepaid-bill/Search';
    import {mdbContainer, mdbTab, mdbTabItem, mdbIcon, mdbTabContent, mdbTabPane, mdbCol, mdbRow} from 'mdbvue';

    export default {
        name: "Purchase",
        components: {
            Search,
            mdbContainer,
            mdbTab,
            mdbTabItem,
            mdbIcon,
            mdbTabContent,
            mdbTabPane,
            mdbCol,
            mdbRow,
        },
        data() {
            return {
                tab: 'prepaid.bill.search',
                spinner_status: 0,
            };
        },
        mounted() {
            this.gotoTab(this.tab);
        },
        methods: {
            gotoTab(tab) {
                this.tab=tab;
                this.$router.push({ name: tab }).catch((err)=>{
                    if (err.name !== "NavigationDuplicated") {
                        throw err;
                    }
                });
            }
        },
        computed: {
            paymentStatus() {
                return this.$store.getters.getPaymentStatus;
            },
        },
        watch: {
            paymentStatus() {
                this.spinner_status = this.paymentStatus;
            }
        }
    }
</script>

