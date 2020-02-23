<template>
    <div>
        <b-card no-body>
            <b-tabs card>
                <b-tab no-body title="Picture 1">
                    <b-card-img bottom src="https://picsum.photos/600/200/?image=21"></b-card-img>
                    <b-card-footer>Picture 1 footer</b-card-footer>
                </b-tab>

                <b-tab no-body title="Picture 2">
                    <b-card-img bottom src="https://picsum.photos/600/200/?image=25"></b-card-img>
                    <b-card-footer>Picture 2 footer</b-card-footer>
                </b-tab>

                <b-tab no-body title="Picture 3">
                    <b-card-img bottom src="https://picsum.photos/600/200/?image=26"></b-card-img>
                    <b-card-footer>Picture 3 footer</b-card-footer>
                </b-tab>

                <b-tab title="Text">
                    <b-card-title>This tab does not have the <code>no-body</code> prop set</b-card-title>
                    <b-card-text>
                        Quis magna Lorem anim amet ipsum do mollit sit cillum voluptate ex nulla tempor. Laborum
                        consequat non elit enim exercitation cillum aliqua consequat id aliqua. Esse ex
                        consectetur mollit voluptate est in duis laboris ad sit ipsum anim Lorem. Incididunt
                        veniam velit elit elit veniam Lorem aliqua quis ullamco deserunt sit enim elit aliqua
                        esse irure.
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    import ListFilters from '../components/ListFilters'
    import pagination from 'laravel-vue-pagination'
    export default {
        data() {
            return{
                create_url: '/admin/landlord/create',
                show: false,
                activeFiltersColor: '#4CA3B8',
                inactiveFiltersColor: '#5a6268',
                balanceColor: '#5a6268'

            }
        },
        created() {
            this.$store.dispatch('loadLandlords');
            this.$store.dispatch('loadFilters');
        },
        mounted() {
            this.$i18n.locale = document.documentElement.lang;
        },
        computed: {
            landlords() {
                return this.$store.getters.getLandlords;
            },
            filters() {
                return this.$store.getters.getFilters;
            },
            landlordFilter: {
                set( landlordFilter ) {
                    this.$store.commit( 'setLandlordFilter', landlordFilter );
                },
                get() {
                    return this.$store.getters.getLandlordFilter;
                }
            },
            userFilter: {
                set(userFilter) {
                    this.$store.commit('setUserFilter', userFilter);
                },
                get() {
                    return this.$store.getters.getUserFilter;
                }
            },
            startDateFilter: {
                set(startDateFilter) {
                    this.$store.commit('setStartDateFilter', startDateFilter);
                },
                get() {
                    return this.$store.getters.getStartDateFilter;
                }
            },
            endDateFilter: {
                set(endDateFilter) {
                    this.$store.commit('setEndDateFilter', endDateFilter);
                },
                get() {
                    return this.$store.getters.getEndDateFilter;
                }
            },
            landlordsLoadStatus() {
                return this.$store.getters.getLandlordsLoadStatus;
            }
        },
        components: {
            ListFilters,
            pagination
        },
        methods: {
            changePage(page) {
                this.$store.commit('setPageNumber', page);
                this.$store.dispatch('loadLandlords');
            },
            reload() {
                this.$store.commit('setPageNumber', '');
                this.$store.dispatch('loadLandlords')
            },
            clearFilters() {
                this.$store.dispatch('resetFilters');
            },
            // downloadLandlords() {
            //     this.$store.dispatch('downloadLandlords')
            // },
            toggle() {
                this.show = !this.show;
            },
        },
        watch: {
            landlordFilter: function () {
                this.reload();
            },
            userFilter: function () {
                this.reload();
            },
            // startDateFilter: function () {
            //     this.reload();
            // },
            // endDateFilter: function () {
            //     this.reload();
            // }
        }
    }
</script>

<style scoped>
    pre {
        user-select: all;
        margin: 0;
        padding: 10px 0;
        white-space: pre-wrap;
    }

    .loading {
        position: fixed;
        z-index: 999;
        height: 2em;
        width: 2em;
        overflow: visible;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
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
