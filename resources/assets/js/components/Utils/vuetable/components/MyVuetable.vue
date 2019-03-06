<template>

    <div class="row">
        <filter-bar
                @filter-set="filterSet"
                @filter-reset="filterReset"
                class="roboto-slab"
                :placeholder="placeholder"
        ></filter-bar>
        <vuetable ref="vuetable"
                  :api-url="api_url"
                  :fields="fields"
                  pagination-path=""
                  @vuetable:cell-clicked="onCellClicked"
                  @vuetable:pagination-data="onPaginationData"
                  @vuetable:loading="onLoading"
                  @vuetable:load-success="onLoadSuccess"
                  @vuetable:load-error="onLoadError"
                  :append-params="moreParams"
                  class="roboto-slab"
                  :css="tableCss"
        ></vuetable>
        <detail-row></detail-row>
        <div class="vuetable-pagination row">
            <vuetable-pagination-info ref="paginationInfo"
                                      class="roboto-slab "
                                      paginationInfoClass="col l12 text-accent-4 large "
                                      :css="paginationCss"
                                      :icons="paginationIcons"
            ></vuetable-pagination-info>

            <vuetable-pagination ref="pagination"
                                 @vuetable-pagination:change-page="onChangePage"
                                 class="roboto-slab"
                                :css="paginationCss"
                                 :icons="paginationIcons"
                                 :wrapperClass="paginationCss.wrapperClass"
            ></vuetable-pagination>
        </div>

    </div>
</template>

<script>
    import Vuetable from 'vuetable2-bootstrap/src/components/Vuetable.vue';
    import VuetablePagination from 'vuetable2-bootstrap/src/components/VuetablePagination';
    import VuetablePaginationInfo from 'vuetable2-bootstrap/src/components/VuetablePaginationInfo';
    import DetailRow from '../DetailRow';
    import FilterBar from '../FilterBar';

    Vue.component('filter-bar', FilterBar);

    export default {

        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
            DetailRow
        },

        props: ['api_url', 'fields', 'placeholder'],

        data() {
            return {
                moreParams: {},
                tableCss : {
                    tableClass: 'highlight centered responsive-table',
                    loadingClass: 'loading',
                    ascendingIcon: 'keyboard_arrow_down',
                    descendingIcon: 'keyboard_arrow_up',
                    detailRowClass: 'vuetable-detail-row left-align',
                },
                paginationCss : {
                    wrapperClass: 'pointer right',
                    activeClass: 'active cyan',
                    disabledClass: 'disabled',
                    pageClass: '',
                    linkClass: 'icon item',
                    paginationClass: '',
                    paginationInfoClass: '',
                },
                paginationIcons : {
                    first: '',
                    prev: '',
                    next: '',
                    last: '',
                }
            }
        },
        created() {
            this.fields.unshift({
                name: '__sequence',   // <----
                title: 'Sr. No.',
                titleClass: 'center aligned',
                dataClass: 'center aligned'
            });
        },
        methods: {
            allcap (value) {
                return value.toUpperCase()
            },
//            genderLabel (value) {
//                return value === 'M'
//                    ? '<span class="ui teal label"><i class="large man icon"></i>Male</span>'
//                    : '<span class="ui pink label"><i class="large woman icon"></i>Female</span>'
//            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData);
                this.$refs.paginationInfo.setPaginationData(paginationData);
            },
            onChangePage (page) {
                console.log(page);

                this.$refs.vuetable.changePage(page)
            },
            onCellClicked (data, field, event) {
                this.$refs.vuetable.toggleDetailRow(data.id)
            },
            filterSet(filterText) {
                this.moreParams = {
                    'filter': filterText
                };
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            },
            filterReset() {
                this.moreParams = {};
                this.$refs.vuetable.refresh();
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            },
            refresh() {
                Vue.nextTick( () => this.$refs.vuetable.refresh())
            },
            onLoading() {
                window.NProgress.start();
            },
            onLoadSuccess() {
                window.NProgress.done();
                this.$emit('table-refreshed',null);
            },
            onLoadError() {
                window.NProgress.done();
                window.error("Error While Loading Data");
            }
        },
        watch : {
            api_url () {
                this.refresh();
            }
        }
    }
</script>

<style scoped>
    .left-align {
        text-align: left !important;
    }
    .container .row {
        margin-left: 0;
        margin-right: 0;
    }
</style>