<template>
    <div class="row">
        <div :id="modalId" class="modal raleway">
            <div class="modal-content">
                <div class="row">
                    <h4 class="cyan-text">Edit {{ modalType | capitalize }}</h4>
                    <hr>
                </div>
                <div class="row">
                    <form>
                        <slot name="form_fields">

                        </slot>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="waves-effect waves-light btn blue" :class="{'disabled' : ! validated}" @click="commitChanges">Edit</div>
                <div class="waves-effect waves-light btn-flat red-text modal-close left">Cancel</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {

            }
        },

        props: {
            'modalType': {
                type: String,
                default: ''
            },
            'form': {
                type: Object
            },
            'openModal': {
                type: Function,
                default: (modalId, data) => {
                    window.$('#'+modalId).modal().modal('open');
                }
            },
            'commit': {
                type: Function,
                default: () => {}
            }
        },

        mounted () {
            this.$parent.$parent.$on('edit-item', this.initModal);
        },

        computed : {
            modalId () {
                return 'edit-modal';
            },
            validated() {
                return ! this.$parent.errors.any();
            },
        },

        filters: {
            capitalize(value) {
                return value.charAt(0).toUpperCase() + value.slice(1);
            },
        },

        methods : {
            clear () {
                for(let attribute in this.form) {
                    this.form[attribute] = '';
                }
                this.$parent.errors.clear();
                window.setTimeout( () => {
                    window.Materialize.updateTextFields();
                }, 50);
            },
            reloadTable() {
                this.$parent.$emit("table-reload");
            },
            commitChanges () {
                this.commit(this.reloadTable, this.modalId);
            },
            initModal (data) {
                this.openModal(this.modalId, data);
            }
        }
    }
</script>