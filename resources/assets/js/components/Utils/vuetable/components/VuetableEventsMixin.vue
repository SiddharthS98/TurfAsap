<script>
    export default {
        mounted () {
            this.$on("select-item", this.onSelect);
            this.$on("edit-item", this.onEdit);
            this.$on("delete-item", this.onDelete);
            this.$on("upload-image-item", this.onUploadImage);
            this.$on("reload-item", this.handleReload);
            this.$on("table-reload", this.handleReload);
        },
        methods : {
            handleReload() {
                this.$refs.vuetable.refresh();
            },
            handleReloadWithSamePage() {
                this.$refs.vuetable.$refs.vuetable.loadData();
            },
            onEdit() {

            },
            onDelete() {

            },
            onSelect() {

            },
            onUploadImage() {

            }
        }
    }
</script>