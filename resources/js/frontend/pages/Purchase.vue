<template>
    <mdb-row>
        <mdb-col md="3">
            <mdb-tab pills color="primary" class="nav-pills" vertical key="tabs">
                <mdb-tab-item class="mt-4" key="electricity-tab" :active="tab=='electricity.search'" @click.native.prevent="gotoTab('electricity.search')">
                    <mdb-icon icon="plug" class="ml-2"/> {{ $t(`dashboard.pages.tabs.titles.electricity`) }}
                </mdb-tab-item>
                <mdb-tab-item class="mt-4" key="water-tab" :active="tab=='water'" @click.native.prevent="gotoTab('water')">
                    <mdb-icon icon="file" class="ml-2"/> Orders & Invoices
                </mdb-tab-item>
                <mdb-tab-item class="mt-4" key="recharge-tab" :active="tab=='recharge'" @click.native.prevent="gotoTab('recharge')">
                    <mdb-icon icon="address-card" class="ml-2"/> Billing Details
                </mdb-tab-item>
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
    import Search from '../components/electricity/Search'
    export default {
        name: "Purchase",
        components: {
            Search
        },
        data() {
            return {
                tab: 'electricity.search',
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
        }
    }
</script>
