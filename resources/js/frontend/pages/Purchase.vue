<template>
    <mdb-row>
        <mdb-col md="3">
            <mdb-tab pills color="primary" class="nav-pills" vertical>
                <mdb-tab-item class="mt-4" key="nav1" :active="tab=='electricity'" @click.native.prevent="tab='electricity'">
                    <mdb-icon icon="plug" class="ml-2"/> {{ $t(`dashboard.pages.tabs.titles.electricity`) }}
                </mdb-tab-item>
                <mdb-tab-item class="mt-4" key="nav2" :active="tab=='water'" @click.native.prevent="tab='water'">
                    <mdb-icon icon="file" class="ml-2"/> Orders & Invoices
                </mdb-tab-item>
                <mdb-tab-item class="mt-4" key="nav3" :active="tab=='recharge'" @click.native.prevent="tab='recharge'">
                    <mdb-icon icon="address-card" class="ml-2"/> Billing Details
                </mdb-tab-item>
            </mdb-tab>
        </mdb-col>
        <mdb-col md="9">
            <mdb-tab-content vertical>
                <mdb-tab-pane class="active" key="pills1" v-if="tab=='electricity'">
                    <keep-alive>
                        <search></search>
                    </keep-alive>
                </mdb-tab-pane>
                <mdb-tab-pane class="fade" key="pills2" v-if="tab=='water'"><h5 class="my-2 h5">Panel 2</h5></mdb-tab-pane>
                <mdb-tab-pane class="fade" key="pills3" v-if="tab=='recharge'"><h5 class="my-2 h5">Panel 3</h5></mdb-tab-pane>
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
