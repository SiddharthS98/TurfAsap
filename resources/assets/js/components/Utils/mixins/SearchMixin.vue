<script>
    export default {
        data () {
            return {
                filterQuery : '',
            }
        },
        methods : {
            search () {
                this.fetchData();
            }
        }
    }
</script>