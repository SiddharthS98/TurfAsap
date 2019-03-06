<script>
    export default {
        props: {
            rowData: {
                type: Object,
                required: true
            },
            rowIndex: {
                type: Number
            }
        },
        computed : {
            user_id () {
                return window.user_id
            }
        },
        methods: {
            itemAction (action, data, index) {
                console.log(action);
                this.$parent.$parent.$parent.$emit(action, {action,data,index});
            },
        },
        mounted () {
            this.$on("button-clicked-event", (data) => {
                this.itemAction(data.action, this.rowData, this.rowIndex);
            });
        }
    }
</script>