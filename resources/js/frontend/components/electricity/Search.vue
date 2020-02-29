<template>
    <mdb-card>
        <mdb-card-body class="text-center">
            <mdb-card-title> {{ $t(`dashboard.pages.tabs.content.electricity.title`) }} </mdb-card-title>
            <mdb-card-text>Some quick example text to build on the card title and make up the bulk of the card's content.</mdb-card-text>

            <mdb-form-inline>
                <mdb-input type="radio" id="option5-1" name="groupOfMaterialRadios2" radioValue="1" v-model="radio5" label="1" />
                <mdb-input type="radio" id="option5-2" name="groupOfMaterialRadios2" radioValue="2" v-model="radio5" label="2" />
                <mdb-input type="radio" id="option5-3" name="groupOfMaterialRadios2" radioValue="3" v-model="radio5" label="3" />
            </mdb-form-inline>

            <mdb-btn @click.native.prevent color="primary">Button</mdb-btn>

        </mdb-card-body>
    </mdb-card>
</template>

<script>
    import { mdbCard, mdbCardBody, mdbCardTitle, mdbBtn, mdbBt, mdbCardText, mdbFormInline, mdbInput } from 'mdbvue';

    export default {
        components: {
            mdbCard,
            mdbCardBody,
            mdbCardTitle,
            mdbCardText,
            mdbBtn,
            mdbInput,
            mdbFormInline
        },

        data() {
            return {
                radio5: ''
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
