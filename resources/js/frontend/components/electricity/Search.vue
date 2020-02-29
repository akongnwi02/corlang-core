<template>
    <mdb-card>
        <mdb-card-body class="text-center">
            <mdb-card-title> {{ $t(`dashboard.pages.tabs.content.electricity.title`) }} </mdb-card-title>
            <mdb-card-text> {{ $t(`dashboard.pages.tabs.content.electricity.description`) }} </mdb-card-text>
            <div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="defaultInline1" name="inlineDefaultRadiosExample">
                    <label class="custom-control-label" for="defaultInline1">{{ $t(`dashboard.pages.tabs.content.electricity.prepaid`) }}</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample">
                    <label class="custom-control-label" for="defaultInline2">{{ $t(`dashboard.pages.tabs.content.electricity.postpaid`) }}</label>
                </div>
            </div>

            <mdb-row>
                <mdb-col md="6">
                    <mdb-input :label="$t(`dashboard.pages.tabs.content.electricity.meter_code`)" v-model="value" />
                </mdb-col>
                <mdb-col md="6">
                    <mdb-input :label="$t(`dashboard.pages.tabs.content.electricity.amount`) + ' (XAF)'" v-model="value" />
                </mdb-col>
            </mdb-row>
            <services></services>
            <div>
                <mdb-btn color="primary">{{ $t(`dashboard.pages.tabs.content.electricity.next`) }}</mdb-btn>
            </div>

        </mdb-card-body>
    </mdb-card>
</template>

<script>

    import Services from '../services/Services'
    export default {
        name: "Search",
        components: {
            Services
        },
        data() {
            return {
                radio5: '',
                switchValue: true,
                value: '',
            };
        },
        methods: {
            toggleActiveState3() {
                this.active3 = !this.active3;
            },
            toggleActiveState4() {
                this.active4 = !this.active4;
            }
        }
    }

</script>
