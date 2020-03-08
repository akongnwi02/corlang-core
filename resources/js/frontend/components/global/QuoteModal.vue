<template>
    <mdb-container class="mt-5">
        <mdb-modal :show="showModal" @close="$emit('closed')">
            <mdb-modal-header>
                <mdb-modal-title>Modal title</mdb-modal-title>
            </mdb-modal-header>
            <mdb-modal-body>
                <mdb-container fluid class="text-white">
                    <mdb-row>
                        <mdb-col md="4" class="bg-info">.col-md-4</mdb-col>
                        <mdb-col md="4" class="ml-auto bg-info">.col-md-4 .ml-auto</mdb-col>
                    </mdb-row>
                    <br />
                    <mdb-row>
                        <mdb-col md="3" class="ml-auto bg-info">.col-md-3 .ml-auto</mdb-col>
                        <mdb-col md="2" class="ml-auto bg-info">.col-md-2 .ml-auto</mdb-col>
                    </mdb-row>
                    <mdb-row>
                        <mdb-col md="6" class="ml-5 bg-info">.col-md-6 .ml-5</mdb-col>
                    </mdb-row>
                    <br />
                    <mdb-row>
                        <mdb-col sm="9" class="bg-info">
                            Level 1: .col-sm-9
                            <mdb-row>
                                <mdb-col sm="6" class="bg-info">
                                    Level 2: .col-8 .col-sm-6
                                </mdb-col>
                                <mdb-col sm="6" class="bg-info">
                                    Level 2: .col-4 .col-sm-6
                                </mdb-col>
                            </mdb-row>
                        </mdb-col>
                    </mdb-row>
                </mdb-container>
            </mdb-modal-body>
            <mdb-modal-footer>
                <mdb-btn size="sm" color="secondary" @click.native="$emit('closed')">{{ $t('dashboard.pages.general.close') }}</mdb-btn>
                <mdb-btn size="sm" color="primary">{{ $t('dashboard.pages.general.confirm') }}</mdb-btn>
            </mdb-modal-footer>
        </mdb-modal>
    </mdb-container>
</template>

<script>
    export default {
        name: "QuoteModal",
        props: ['showModal'],
    }
</script>
