<template>
    <div :id="modalId" class="modal raleway">
        <div class="modal-content">
            <div class="row">
                <h4>Delete confirmation.</h4>
                <hr>
            </div>
            <div class="row">
                <p> Are you sure you want to delete? </p>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="waves-effect waves-light btn red" @click="commitChanges">Yes</a>
            <a href="#!" class="waves-effect waves-light modal-close btn-flat red-text left">No</a>
        </div>
    </div>

</template>

<script>
    export default {
        props : ['type','api'],
        data () {
            return {
                data : {}
            }
        },
        computed : {
            apiUrl () {
                return typeof this.api == undefined ? `/api/${this.type}/${this.data.data.id}` : `${this.api}/${this.data.data.id}`
            },
            modalType() {
                return `${this.type}-delete-modal`
            },
            modalId () {
                return `${this.modalType}-${new Date().getTime()}`
            }
        },
        mounted () {
            this.$parent.$on(`delete-item`, this.openModal);
        },
        methods : {
            openModal (data) {
                this.data = data;

                window.$('#'+this.modalId).modal().modal('open');
            },
            reloadTable () {
                this.$emit("table-reload");
            },
            commitChanges () {
                window.NProgress.start();

                window.axios.delete(this.apiUrl)
                    .then( (response) => {
                        window.NProgress.done();
                        if(response.data.success) {
                            window.$('#'+this.modalId).modal().modal('close');
                            window.success("Deleted!");
                            this.reloadTable();
                        } else {
                            window.error(response.data.error);
                        }
                    })
                    .catch( (error) => {
                       window.logError(error);
                    });

            }
        }
    }
</script>