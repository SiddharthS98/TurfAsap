<script>
    import VuetablePagination from 'vuetable2-bootstrap/src/components/VuetablePagination';
    import VuetablePaginationInfo from 'vuetable2-bootstrap/src/components/VuetablePaginationInfo';

    export default {
        components: {
            VuetablePagination,
            VuetablePaginationInfo,
        },
        data () {
            return {
                perPage : 9,
                page : 1,
                totalPages : 1,
                from : 1,
                to : 1,
                total : 1,
                paginationCss : {
                    wrapperClass: 'pointer right',
                    activeClass: 'active black',
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
        watch : {
            page () {
                this.fetchData();
            }
        },
        computed : {
            isBackPossible () {
                return this.page - 1 < 0
            },
            isForwardPossible () {
                return this.page == this.totalPages
            }
        },
        methods : {
            next () {
                this.page = this.isForwardPossible ? this.page : this.page+1;
            },
            back () {
                this.page = this.isBackPossible ? 0 : this.page-1;
            },
            goTo (index) {

                if (index > this.page) {
                    for (; index >= this.page; index--)
                        this.next();
                } else if (index < this.page) {
                    for (; index <= this.page; index++)
                        this.back();
                } else if (index == this.page) {
                }
            },
            setPaginateData (data) {
                this.onPaginationData(data);
                this.totalPages = data.last_page;
                this.from = data.from;
                this.to = data.to;
                this.total = data.total;
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData);
                this.$refs.paginationInfo.setPaginationData(paginationData);
            },
            onChangePage (page) {
                this.goTo(page);
            },


        }
    }
</script>