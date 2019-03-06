<template>
    <div class="container">
        <div class="row">

            <div class="col s12 m12 l12">
                <h3>
                    <transition name="fade"
                                mode="out-in"
                    >
                    <span v-if="!isSearching" key="normal">
                        Browse Turfs
                    </span>
                        <span v-else key="searching">
                        Search Turfs
                    </span>
                    </transition>
                </h3>
            </div>

            <div class="col l12 m12 s12">
                <div class="input-field col l11 m11 s11">
                    <i class="material-icons prefix">search</i>
                    <input id="icon_prefix" type="text" class="roboto-slab validate" v-model="filterQuery" @keyup.enter="search()" placeholder="Turf Name, Location, Facility...">
                </div>
                <div class="col l1 m1 s1">
                    <br class="hide-on-med-and-down" />
                    <button class="btn black blue waves-effect waves-light btn-floating" @click="search()" ><i class="material-icons">send</i></button>

                </div>
            </div>
        </div>


        <material-card-container

                @select-button-clicked="onButtonClicked"
                ref="cardContainer"
        >
        </material-card-container>

        <div class="col l12 m12 s12">
            <div class="vuetable-pagination row">
                <vuetable-pagination-info ref="paginationInfo"
                                          class="roboto-slab "
                                          paginationInfoClass="col l12 text-accent-4 large "
                                          :css="paginationCss"
                                          paginationInfoNoDataTemplate=""
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
    </div>
</template>

<script>

    import PaginateMixin from './../utils/mixins/PaginateMixin.vue';
    import SearchMixin from './../utils/mixins/SearchMixin.vue'
    import SortMixin from './../utils/mixins/SortMixin.vue'

    import materialCardContainer from './Utils/MaterialCardContainer.vue'

    export default {
        mixins : [PaginateMixin, SearchMixin, SortMixin],
        props: ['url', 'search_query', 'image_route'],
        components : {
            materialCardContainer
        },
        mounted() {
            if(this.search_query !== "" && typeof this.search_query !== undefined) {
                this.filterQuery = this.search_query;
            }
            this.fetchData()
        },
        computed: {
            isSearching() {
                return this.filterQuery !== "";
            }
        },
        methods: {
            fetchData () {
                window.NProgress.start();
                let url = `${this.url}/?sort=${this.sortString}&filter=${this.filterQuery}&page=${this.page}&per_page=${this.perPage}`;
                window.axios.get(url)
                    .then( (response) => {
                        window.NProgress.done();
                        this.$refs.cardContainer.cardArray = response.data.data;
                        this.setPaginateData(response.data);
                        window.history.pushState('turfs', 'Title', 'turfs');
                    })
                    .catch( (error) => window.error(error) );
            },
            onButtonClicked () {

            },

        }
    }
</script>
