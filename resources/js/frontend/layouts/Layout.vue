<template>
    <mdb-container>
        <!--<navigation></navigation>-->
        <mdb-tab-content>
            <!--<router-view></router-view>-->
        </mdb-tab-content>
    </mdb-container>
</template>

<script>
    import { mdbTabContent, mdbContainer } from 'mdbvue';
    import { ChangeLanguage }from '../mixins/local/ChangeLanguage'

    import Navigation from '../components/global/Navigation';

    export default {

        mixins: [
            ChangeLanguage,
        ],

        components: {
            Navigation,
            mdbTabContent,
            mdbContainer,
        },

        data() {
            return {
                pillsActive: 1,
                verticalWithin: 1
            };
        },
        mounted() {
            console.log('works');
        }
    }
</script>
