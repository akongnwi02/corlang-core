<template>
    <mdb-tab-pane key="show1">
        <mdb-row>
            <mdb-col md="3">
                <mdb-tab pills color="primary" class="nav-pills" vertical>
                    <mdb-tab-item class="mt-4" key="nav1" :active="tab==='electricity'" @click.native.prevent="gotoTab('electricity')">
                        <mdb-icon icon="plug" class="ml-2"/> {{ $t(`dashboard.pages.tabs.titles.electricity`) }}
                    </mdb-tab-item>
                    <mdb-tab-item class="mt-4" key="nav2" :active="tab===2" @click.native.prevent="tab=2">
                        <mdb-icon icon="file" class="ml-2"/> Orders & Invoices
                    </mdb-tab-item>
                    <mdb-tab-item class="mt-4" key="nav3" :active="tab===3" @click.native.prevent="tab=3">
                        <mdb-icon icon="address-card" class="ml-2"/> Billing Details
                    </mdb-tab-item>
                </mdb-tab>
            </mdb-col>
            <mdb-col md="9" class="inner">
                <mdb-tab-content vertical>
                    <router-view></router-view>
                </mdb-tab-content>
            </mdb-col>
        </mdb-row>
    </mdb-tab-pane>
</template>

<script>

    export default {
        name: "Purchase",
        data() {
            return {
                tab: 'electricity'
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

<style scoped>
    .inner {
        display: table;
        margin: 0 auto;
    }
</style>
