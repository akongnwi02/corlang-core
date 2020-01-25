<template>
    <div class="card">
        <div class="card-header">
            <div class="row ml-1">
                <div v-if="landlordsLoadStatus===2">
                    <a v-if="show" v-on:click="toggle()" class="navbar-brand" href="#">{{ $t(`business.landlord.filters.hide_filters`) }}</a>
                    <a v-else v-on:click="toggle()" class="navbar-brand" href="#">{{ $t(`business.landlord.filters.show_filters`) }}</a>

                    <a v-on:click="clearFilters()" data-toggle="tooltip" :title="$t(`business.landlord.filters.clear_filters`)"class="navbar-brand" href="#"><span class="fa fa-filter" aria-hidden="false"></span></a>
                </div>
                <!--<div class="ml-auto mr-3" v-on:click="downloadlandlords()">-->
                    <!--<div class="btn btn-sm btn-info" style="cursor:pointer;">-->
                        <!--<a href="#" class="fa fa-download"></a> {{ $t(`business.landlord.list.download`) }}-->
                    <!--</div>-->
                <!--</div>-->
            </div>
            <transition name="slide">
                <div v-if="show" class="row">
                    <label class="col-form-label col-md-3">{{ $t(`business.landlord.filters.landlord`) }}:
                        <select v-model="landlordFilter" class="form-control">
                            <option value=""></option>
                            <option v-for="landlord in filters.landlords" v-bind:value="landlord">{{landlord}}</option>
                        </select>
                    </label>
                    <!--<label class="col-form-label col-md-3">{{ $t(`business.landlord.filters.user`) }}:-->
                        <!--<select v-model="userFilter" class="form-control">-->
                            <!--<option value=""></option>-->
                            <!--<option v-for="user in filters.users" v-bind:value="user">{{user}}</option>-->
                        <!--</select>-->
                    <!--</label>-->
                    <!--<label class="col-form-label col-md-3">{{ $t(`business.landlord.filters.start_date`) }}:-->
                        <!--<input v-model="startDateFilter" class="form-control start_date" type="date" value="">-->
                    <!--</label>-->
                    <!--<label class="col-form-label col-md-3">{{ $t(`business.landlord.filters.end_date`) }}:-->
                        <!--<input v-model="endDateFilter" class="form-control end_date" type="date" value="">-->
                    <!--</label>-->
                </div>
            </transition>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ $t(`business.landlord.list.title`) }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    <!--<div class="btn-toolbar float-right" role="toolbar" :aria-label="$t(`business.landlord.list.create_new`)">-->
                        <!--<a :href="create_url" class="btn btn-success ml-1" data-toggle="tooltip" :title="$t(`business.landlord.list.create_new`)"><i class="fas fa-plus-circle"></i></a>-->
                    <!--</div>-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ $t(`business.landlord.list.table.name`) }}</th>
                                <th>{{ $t(`business.landlord.list.table.user_assigned`) }}</th>
                                <th>{{ $t(`business.landlord.list.table.full_ownership`) }}</th>
                                <th>{{ $t(`business.landlord.list.table.commission`) }}</th>
                                <th>{{ $t(`business.landlord.list.table.balance`) }}</th>
                                <th>{{ $t(`business.landlord.list.table.action`) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="landlordsLoadStatus===2" v-for="landlord in landlords.data" :key="landlord.id" :landlord="landlord">
                                <td>{{ landlord.name }}</td>
                                <td v-if="landlord.user"><i class="fas fa-check"></i></td><td v-else><i class="fas fa-times"></i></td>
                                <td v-if="landlord.is_full_ownership"><i class="fas fa-check"></i></td><td v-else><i class="fas fa-times"></i></td>
                                <td v-if="landlord.is_full_ownership">{{'N/A'}}</td><td v-else>{{ landlord.commission ? landlord.commission + '%': 'Not set'}}</td>
                                <td v-if="landlord.balance > 0">{{ landlord.balance + ' FCFA'}}</td><td v-else style="color: red;">{{ landlord.balance ? landlord.balance + ' FCFA' : '0 FCFA'}}</td>
                                <td v-html="landlord.action_buttons"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-show="landlordsLoadStatus===1" class="loading spinner-border text-primary" role="status">
                            <span id="busy" class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left" v-if="landlordsLoadStatus===2">
                        {{ $tc(`business.landlord.list.table.total`, landlords.meta.total, { count: landlords.meta.total }) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        <pagination v-if="landlordsLoadStatus===2" :data="landlords" :limit="1" @pagination-change-page="changePage">
                            <span slot="prev-nav">‹</span>
                            <span slot="next-nav">›</span>
                        </pagination>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
</template>

<script>
    import ListFilters from '../components/ListFilters'
    import pagination from 'laravel-vue-pagination'
    export default {
        data() {
            return{
                create_url: '/admin/business/search',
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