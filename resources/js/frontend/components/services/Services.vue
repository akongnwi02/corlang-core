<template>
    <div class="row ml-1 mr-1">
        <div v-for="service in services" class="cc-selector-2">
            <input :id="service.uuid" type="radio" name="service" :value="service.name" v-on:change="emitToParent(service)"/>
            <label class="drinkcard-cc visa mr-1" :for="service.uuid" :style="{ backgroundImage: 'url(\'' + getImageUrl(service.logo_url) + '\')' }" ></label>
        </div>
    </div>
</template>

<script>
    import {BUSINESS_CONFIG} from "../../config/business";

    export default {
        name: "Services",
        props: ['services'],
        methods: {
            getImageUrl(logo_url){
                return BUSINESS_CONFIG.SERVER_STORAGE_PATH + '/' + logo_url
            },
            emitToParent(service) {
                this.$emit('selected', service);
            }
        }
    }
</script>

<style scoped>
    .cc-selector input{
        margin:0;padding:0;
        -webkit-appearance:none;
        -moz-appearance:none;
        appearance:none;
    }

    .cc-selector-2 input{
        position:absolute;
        z-index:999;
    }

    .cc-selector-2 input:active +.drinkcard-cc, .cc-selector input:active +.drinkcard-cc{opacity: .9;}
    .cc-selector-2 input:checked +.drinkcard-cc, .cc-selector input:checked +.drinkcard-cc{
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
    }

    .drinkcard-cc{
        cursor:pointer;
        background-size:contain;
        background-repeat:no-repeat;
        display:inline-block;
        width:100px;height:70px;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
        -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
        filter: brightness(1.8) grayscale(1) opacity(.7);
    }

    .drinkcard-cc:hover{
        -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
        -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
        filter: brightness(1.2) grayscale(.5) opacity(.9);
    }

    /* Extras */
    a:visited{color:#888}
    a{color:#444;text-decoration:none;}
    p{margin-bottom:.3em;}
</style>
