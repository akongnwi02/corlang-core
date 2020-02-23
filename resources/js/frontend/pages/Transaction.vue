<template>
    <div class="card">
        <div class="card-header">
            <div class="row ml-1">
                <div v-if="transactionsLoadStatus===2" v-show="transactions.extra.canFilterTransactions">
                    <a v-if="show" v-on:click="toggle()" class="navbar-brand" href="#">{{ $t(`business.transaction.filters.hide_filters`) }}</a>
                    <a v-else v-on:click="toggle()" class="navbar-brand" href="#">{{ $t(`business.transaction.filters.show_filters`) }}</a>

                    <a v-on:click="clearFilters()" data-toggle="tooltip" :title="$t(`business.transaction.filters.clear_filters`)" class="navbar-brand" href="#"><span class="fa fa-filter" aria-hidden="false"></span></a>
                </div>
                <div class="ml-auto mr-3" v-on:click="downloadTransactions()">
                    <div class="btn btn-sm btn-info" style="cursor:pointer;">
                        <a href="#" class="fa fa-download"></a> {{ $t(`business.transaction.list.download`) }}
                    </div>
                </div>
            </div>
            <transition name="slide">
                <div v-if="show" class="row">
                    <label class="col-form-label col-md-3">{{ $t(`business.transaction.filters.landlord`) }}:
                        <select v-model="landlordFilter" class="form-control">
                            <option value=""></option>
                            <option v-for="landlord in filters.landlords" v-bind:value="landlord">{{landlord}}</option>
                        </select>
                    </label>
                    <label class="col-form-label col-md-3">{{ $t(`business.transaction.filters.user`) }}:
                        <select v-model="userFilter" class="form-control">
                            <option value=""></option>
                            <option v-for="user in filters.users" v-bind:value="user">{{user}}</option>
                        </select>
                    </label>
                    <label class="col-form-label col-md-3">{{ $t(`business.transaction.filters.start_date`) }}:
                        <input v-model="startDateFilter" class="form-control start_date" type="date" value="">
                    </label>
                    <label class="col-form-label col-md-3">{{ $t(`business.transaction.filters.end_date`) }}:
                        <input v-model="endDateFilter" class="form-control end_date" type="date" value="">
                    </label>
                </div>
            </transition>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ $t(`business.transaction.list.title`) }}
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" :aria-label="$t(`business.transaction.list.create_new`)">
                        <a :href="create_url" class="btn btn-success ml-1" data-toggle="tooltip" :title="$t(`business.transaction.list.create_new`)"><i class="fas fa-plus-circle"></i></a>
                    </div>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ $t(`business.transaction.list.table.meter_code`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.token`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.amount`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.energy`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.address`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.created_at`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.created_by`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.landlord`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.status`) }}</th>
                                <th>{{ $t(`business.transaction.list.table.number`) }}</th>

                                <th>{{ $t(`business.transaction.list.table.actions`) }}</th>

                            </tr>
                            </thead>

                            <tbody>
                            <tr v-if="transactionsLoadStatus===2" v-for="transaction in transactions.data" :key="transaction.id" :transaction="transaction">
                                <td>{{ transaction.meter_code }}</td>
                                <td style="user-select: all"><code>{{ transaction.token }}</code></td>
                                <td>{{ transaction.payment.amount + ' FCFA'}}</td>
                                <td>{{ transaction.energy + ' KWh' }}</td>
                                <td>{{ transaction.address }}</td>
                                <td>{{ transaction.created_at }}</td>
                                <td>{{ transaction.user.username }}</td>
                                <td>{{ transaction.landlord.name }}</td>
                                <td v-html="transaction.status_label"></td>
                                <td>{{ transaction.number }}</td>

                                <td v-html="transaction.action_buttons"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-show="transactionsLoadStatus===1" class="loading spinner-border text-primary" role="status">
                            <span id="busy" class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left" v-if="transactionsLoadStatus===2">
                        {{ $tc(`business.transaction.list.table.total`, transactions.meta.total, { count: transactions.meta.total }) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        <pagination v-if="transactionsLoadStatus===2" :data="transactions" :limit="1" @pagination-change-page="changePage">
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
                filterActive: false,
            }
        },
        created() {
            this.$store.dispatch('loadTransactions');
            this.$store.dispatch('loadFilters');
        },
        mounted() {
            // Get the language set by laravel
            this.$i18n.locale = document.documentElement.lang;
        },
        computed: {
            transactions() {
                return this.$store.getters.getTransactions;
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
            transactionsLoadStatus() {
                return this.$store.getters.getTransactionsLoadStatus;
            },
            filtersStatus() {
                this.filterActive = !(!this.landlordFilter
                    && !this.userFilter
                    && !this.startDateFilter
                    && !this.endDateFilter);
            },
        },
        components: {
            ListFilters,
            pagination
        },
        methods: {
            changePage(page) {
                this.$store.commit('setPageNumber', page);
                this.$store.dispatch('loadTransactions');
            },
            reload() {
                this.$store.commit('setPageNumber', '');
                this.$store.dispatch('loadTransactions')
            },
            clearFilters() {
                this.$store.dispatch('resetFilters');
            },
            downloadTransactions() {
                this.$store.dispatch('downloadTransactions')
            },
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
            startDateFilter: function () {
                this.reload();
            },
            endDateFilter: function () {
                this.reload();
            }
        }
    }
</script>

<style scoped>
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