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
        <div v-if="spinner_status==1" class="loading spinner-border text-primary" role="status">
            <span id="busy" class="sr-only">{{ $t(`dashboard.pages.general.loading`) }}</span>
        </div>
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

<style>

    .loading {
        position: fixed;
        height: 2em;
        width: 2em;
        overflow: visible;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: 1000;
    }
</style>
