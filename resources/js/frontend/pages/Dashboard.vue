<template>
    <mdb-container>
        <mdb-tab tabs color="primary" justify>
            <mdb-tab-item key="tab1" :active="pillsActive===1" @click.native.prevent="pillsActive=1"><mdb-icon icon="shopping-bag" class="ml-2"/> {{ $t(`dashboard.tabs.titles.purchase`) }} </mdb-tab-item>
            <mdb-tab-item key="tab2" :active="pillsActive===2" @click.native.prevent="pillsActive=2"><mdb-icon icon="list" class="ml-2"/> {{ $t(`dashboard.tabs.titles.transactions`) }} </mdb-tab-item>
        </mdb-tab>
        <mdb-tab-content>
            <mdb-tab-pane class="active" key="show1" v-if="pillsActive===1">
                <mdb-row>
                    <mdb-col md="3">
                        <mdb-tab pills color="primary" class="nav-pills" vertical>
                            <mdb-tab-item class="mt-4" key="nav1" :active="verticalWithin===1" @click.native.prevent="verticalWithin=1"><mdb-icon icon="plug" class="ml-2"/> {{ $t(`dashboard.tabs.panels.titles.electricity`) }} </mdb-tab-item>
                            <mdb-tab-item class="mt-4" key="nav2" :active="verticalWithin===2" @click.native.prevent="verticalWithin=2"><mdb-icon icon="file" class="ml-2"/> Orders & Invoices </mdb-tab-item>
                            <mdb-tab-item class="mt-4" key="nav3" :active="verticalWithin===3" @click.native.prevent="verticalWithin=3"><mdb-icon icon="address-card" class="ml-2"/> Billing Details </mdb-tab-item>
                        </mdb-tab>
                    </mdb-col>
                    <mdb-col md="9">
                        <mdb-tab-content vertical>
                            <mdb-tab-pane class="active" key="pills1" v-if="verticalWithin===1"><h5 class="my-2 h5">Panel 1</h5></mdb-tab-pane>
                            <mdb-tab-pane class="fade" key="pills2" v-if="verticalWithin===2"><h5 class="my-2 h5">Panel 2</h5></mdb-tab-pane>
                            <mdb-tab-pane class="fade" key="pills3" v-if="verticalWithin===3"><h5 class="my-2 h5">Panel 3</h5></mdb-tab-pane>
                        </mdb-tab-content>
                    </mdb-col>
                </mdb-row>
            </mdb-tab-pane>
            <mdb-tab-pane class="fade" key="show2" v-if="pillsActive===2">
                <br/>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. <br><br>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
            </mdb-tab-pane>
        </mdb-tab-content>
    </mdb-container>
</template>

<script>
    import { mdbTab, mdbTabItem, mdbTabContent, mdbTabPane, mdbContainer, mdbCol, mdbRow, mdbIcon, mdbTabs } from 'mdbvue';
    import { ChangeLanguage }from '../mixins/local/ChangeLanguage'

    export default {
        name: 'TabPage',

        mixins: [
            ChangeLanguage,
        ],

        components: {
            mdbTab,
            mdbTabItem,
            mdbTabContent,
            mdbTabPane,
            mdbContainer,
            mdbCol,
            mdbRow,
            mdbIcon,
            mdbTabs
        },

        data() {
            return {
                pillsActive: 1,
                verticalWithin: 1
            };
        },
    }
</script>

<style>

</style>
