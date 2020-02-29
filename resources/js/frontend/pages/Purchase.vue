<template>

    <mdb-tab-pane class="active" key="show1" v-if="pillsActive===1">
        <mdb-row>
            <mdb-col md="3">
                <mdb-tab pills color="primary" class="nav-pills" vertical>
                    <mdb-tab-item class="mt-4" key="nav1" :active="verticalWithin===1" @click.native.prevent="verticalWithin=1">
                        <mdb-icon icon="plug" class="ml-2"/> {{ $t(`dashboard.tabs.panels.titles.electricity`) }}
                    </mdb-tab-item>
                    <mdb-tab-item class="mt-4" key="nav2" :active="verticalWithin===2" @click.native.prevent="verticalWithin=2">
                        <mdb-icon icon="file" class="ml-2"/> Orders & Invoices
                    </mdb-tab-item>
                    <mdb-tab-item class="mt-4" key="nav3" :active="verticalWithin===3" @click.native.prevent="verticalWithin=3">
                        <mdb-icon icon="address-card" class="ml-2"/> Billing Details
                    </mdb-tab-item>
                </mdb-tab>
            </mdb-col>
            <mdb-col md="9">
                <mdb-tab-content vertical>
                    <mdb-tab-pane class="active" key="pills1" v-if="verticalWithin===1"><router-view></router-view></mdb-tab-pane>
                    <mdb-tab-pane class="fade" key="pills2" v-if="verticalWithin===2"><h5 class="my-2 h5">Panel 2</h5></mdb-tab-pane>
                    <mdb-tab-pane class="fade" key="pills3" v-if="verticalWithin===3"><h5 class="my-2 h5">Panel 3</h5></mdb-tab-pane>
                </mdb-tab-content>
            </mdb-col>
        </mdb-row>
    </mdb-tab-pane>
</template>

<script>
    import { mdbTab, mdbTabItem, mdbTabContent, mdbTabPane, mdbCol, mdbRow, mdbIcon } from 'mdbvue';

    export default {
        components: {
            mdbTab,
            mdbTabItem,
            mdbTabContent,
            mdbTabPane,
            mdbCol,
            mdbRow,
            mdbIcon
        },

        data() {
            return {
                pillsActive: 1,
                verticalWithin: 1
            };
        },
    }
</script>
