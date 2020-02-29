<template>
    <div class="row">
        <div v-for="service in services" class="col-md-4">
            <div class="thumbnail">
                <img :src="service.logo_url" :alt="service.name" style="width:50%">
                <div class="caption">
                    <p>{{service.name}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Services",
        props: ['services']
    }
</script>

<style scoped>

</style>
