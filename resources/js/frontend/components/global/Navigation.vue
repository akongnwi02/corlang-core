<template>
    <mdb-tab tabs color="primary" justify>
        <mdb-tab-item key="tab1" :active="pillsActive==='purchase'" @click.native.prevent="gotoPage('purchase')">
            <mdb-icon icon="shopping-bag" class="ml-2"/> {{ $t(`dashboard.pages.titles.purchase`) }}
        </mdb-tab-item>

        <mdb-tab-item key="tab2" :active="pillsActive==='transactions'" @click.native.prevent="gotoPage('transactions')">
            <mdb-icon icon="list" class="ml-2"/> {{ $t(`dashboard.pages.titles.transactions`) }}
        </mdb-tab-item>
    </mdb-tab>
</template>

<script>

    export default {
        name: "Navigation",
        data() {
            return {
                pillsActive: 'purchase',
            };
        },

        methods: {
            gotoPage(page) {
                this.pillsActive=page;
                this.$router.push({ name: page }).catch((err)=>{
                    if (err.name !== "NavigationDuplicated") {
                        throw err;
                    }
                });
            }
        }
    }
</script>

