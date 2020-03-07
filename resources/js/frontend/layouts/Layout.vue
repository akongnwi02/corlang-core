<template>
    <mdb-container>
        <mdb-tab tabs color="primary" justify key="page">
            <mdb-tab-item key="purchase-tab" :active="page=='purchase'" @click.native.prevent="page='purchase'">
                <mdb-icon icon="shopping-bag" class="ml-2"/> {{ $t(`dashboard.pages.titles.purchase`) }}
            </mdb-tab-item>

            <mdb-tab-item key="transactions-tab" :active="page=='transactions'" @click.native.prevent="page='transactions'">
                <mdb-icon icon="list" class="ml-2"/> {{ $t(`dashboard.pages.titles.transactions`) }}
            </mdb-tab-item>
        </mdb-tab>
        <mdb-tab-content key="page-content">
            <mdb-tab-pane key="purchase-content" class="active" v-if="page=='purchase'">
                <keep-alive>
                    <purchase></purchase>
                </keep-alive>
            </mdb-tab-pane>
            <mdb-tab-pane class="fade" key="transactions-content" v-if="page=='transactions'">
                <br/>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. <br><br>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
            </mdb-tab-pane>
        </mdb-tab-content>
    </mdb-container>
</template>

<script>
    import { ChangeLanguage }from '../mixins/local/ChangeLanguage'

    import Purchase from '../pages/Purchase';

    export default {
        name: "Layout",
        mixins: [
            ChangeLanguage,
        ],
        components: {
            Purchase,
        },
        data() {
            return{
                page: 'purchase',
            }
        }
    }
</script>
