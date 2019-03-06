<template>
        <div class="display-inline tooltipped"
             :class="tooltip"
            data-position="top"
            data-delay="50000"
            :data-tooltip="name | displayable">
                <button
                    :class="[css.buttonClass, css.wavesClass, color, floating ? this.defaultClasses.floatingClass : '' ]"
                    :title="name | displayable"
                    @click="buttonClicked"
                >
                <span v-if="text.length > 0"> {{ text }} </span>
                <i :class="['material-icons right', iconClass]" v-if="icon.length > 0"> {{ icon }} </i>
                </button>
        </div>

</template>

<script>
    export default {
        data () {
                return {
                    defaultClasses : {
                        floatingClass : 'btn-floating'
                    }
                }
        },
        props : {
            name : {
                type : String,
                required : true
            },
            css : {
                type : Object,
                default () {
                    return {
                        buttonClass : 'btn',
                        wavesClass : 'waves-effect waves-light',
                    };
                }
            },
            icon : {
                type : String,
                default () {
                    return '';
                }
            },
            iconClass : {
                type : String,
                default () {
                    return ''
                }
            },
            text : {
                type : String,
                default () {
                    return '';
                }
            },
            color : {
                type : String,
                default () {
                    return 'blue';
                }
            },
            floating : {
                type : Boolean,
                default () {
                    return true;
                }
            },
            tooltip : {
                type : String
            }
        },
        methods : {
            buttonClicked() {
                this.$parent.$emit('button-clicked-event', {action: this.name});
            }
        },
        mounted () {
            window.$('.tooltipped').tooltip();
        },
        filters : {
            displayable (val) {
                val = val.split("-item")[0];
                val = val.replace("-"," ");
                val = val.charAt(0).toUpperCase() + val.slice(1).toLowerCase();
                return val;
            }
        }
    }
</script>

<style scoped>
        .display-inline {
                display: inline;
        }
</style>