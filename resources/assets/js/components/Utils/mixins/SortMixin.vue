<script>
    export default {
        data () {
            return {
                sortField : 'updated_at',
                sortDirection : 'desc'
            }
        },
        computed : {
            sortString () {
                return `${this.sortField}|${this.sortDirection}`
            }
        },
        watch : {
            sortField () {
                this.fetchData();
            },
            sortDirection () {
                this.fetchData();
            }
        },
    }
</script>