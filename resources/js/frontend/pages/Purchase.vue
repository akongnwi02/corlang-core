<template>
    <mdb-row>
        <mdb-col md="3">
            <mdb-tab pills color="primary" class="nav-pills" vertical key="tabs">
                <mdb-tab-item class="mt-4" key="electricity-tab" :active="tab=='electricity'" @click.native.prevent="tab='electricity'">
                    <mdb-icon icon="plug" class="ml-2"/> {{ $t(`dashboard.pages.tabs.titles.electricity`) }}
                </mdb-tab-item>
                <mdb-tab-item class="mt-4" key="water-tab" :active="tab=='water'" @click.native.prevent="tab='water'">
                    <mdb-icon icon="file" class="ml-2"/> Orders & Invoices
                </mdb-tab-item>
                <mdb-tab-item class="mt-4" key="recharge-tab" :active="tab=='recharge'" @click.native.prevent="tab='recharge'">
                    <mdb-icon icon="address-card" class="ml-2"/> Billing Details
                </mdb-tab-item>
            </mdb-tab>
        </mdb-col>
        <mdb-col md="9">
            <mdb-tab-content vertical key="tabs-content">
                <mdb-tab-pane class="active" key="electricity-content" v-if="tab=='electricity'">
                    <keep-alive>
                        <search></search>
                    </keep-alive>
                </mdb-tab-pane>
                <mdb-tab-pane class="fade" key="water-content" v-if="tab=='water'"><h5 class="my-2 h5">Panel 2</h5></mdb-tab-pane>
                <mdb-tab-pane class="fade" key="recharge-content" v-if="tab=='recharge'"><h5 class="my-2 h5">Panel 3</h5></mdb-tab-pane>
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
                tab: 'electricity',
            };
        },
    }
</script>
