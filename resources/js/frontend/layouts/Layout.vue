<template>
    <mdb-container>
        <navigation></navigation>
        <mdb-tab-content>
            <transition name="slide">
                <router-view></router-view>
            </transition>
        </mdb-tab-content>
    </mdb-container>
</template>

<script>
    import { ChangeLanguage }from '../mixins/local/ChangeLanguage'

    import Navigation from '../components/global/Navigation';

    export default {
        name: "Layout",
        mixins: [
            ChangeLanguage,
        ],

        components: {
            Navigation,
        },
    }
</script>

<style>
    ul {
        cursor: pointer;
    }

    .slide-enter-active {
        -moz-transition-duration: 0.3s;
        -webkit-transition-duration: 0.3s;
        -o-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -moz-transition-timing-function: ease-in;
        -webkit-transition-timing-function: ease-in;
        -o-transition-timing-function: ease-in;
        transition-timing-function: ease-in;
    }

    .slide-leave-active {
        -moz-transition-duration: 0.3s;
        -webkit-transition-duration: 0.3s;
        -o-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
        -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
        -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
        transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    }

    .slide-enter-to, .slide-leave {
        max-height: 100px;
        overflow: hidden;
    }

    .slide-enter, .slide-leave-to {
        overflow: hidden;
        max-height: 0;
    }
</style>
