<template>
    <div class="row">
        <material-button :name="`add-${modalType}-item`" color="blue right" :floating="false" :text="'Add New ' + modalType " tooltip="right"></material-button>

        <div :id="modalId" class="modal raleway">
            <div class="modal-content">
                <div class="row">
                    <h4>Add {{ modalType | capitalize }}</h4>
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
                <div class="waves-effect waves-light btn green" :class="{'disabled' : ! validated}" @click="commitChanges">Add</div>
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
                default: (modalId) => {
                    window.$('#'+modalId).modal().modal('open');
                }
            },
            'commit': {
                type: Function,
                default: () => {}
            }
        },

        mounted () {
            this.$on('button-clicked-event', this.initModal);

        },

        computed : {
            modalId () {
                return 'add-modal';
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
            initModal () {
                this.clear();
                this.openModal(this.modalId);
            }
        }
    }
</script>