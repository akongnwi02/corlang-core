<template>
    <div v-if="status==1" class="loading spinner-border text-primary" role="status">
        <span id="busy" class="sr-only">{{ $t(`dashboard.pages.general.loading`) }}</span>
    </div>
</template>

<script>
    export default {
        name: "Loader",
        props: ['status']
    }
</script>

<style>
    .loading {
        position: fixed;
        height: 2em;
        width: 2em;
        overflow: visible;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        cursor: pointer;
    }
</style>
