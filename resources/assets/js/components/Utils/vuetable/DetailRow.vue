<template>
    <div @click="onClick">
        <div :id="modalId" class="modal bottom-sheet raleway">
            <div class="modal-content">
                <h4 class="black-text">{{ rowData.name }}
                    <a href="#!" class="modal-action modal-close waves-effect waves-green right btn-flat red-text">
                        <i class="material-icons">close</i>
                    </a>
                </h4>

                <ul class="collection">
                    <li href="#!" class="collection-item" v-for="key in fieldKeys">
                        <span class="badge new left flow-text white-text"  data-badge-caption=" ">{{ key | capitalize | convertDataToText}} </span> &nbsp;&nbsp;&nbsp;
                        <span>{{ rowData[key] }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data()  {
            return {
                ignoreList : [
                    "id",
                    "created_at",
                    "updated_at"
                ],
                rowData : {},
                rowIndex : 0
            }
        },
        mounted () {
            this.$parent.$refs.vuetable.$on("vuetable:cell-clicked", this.openModal)
        } ,

        computed: {
            fieldKeys() {
                return Object.keys(this.rowData).filter((x) => {
                    let containsIgnoredItem = this.ignoreList.filter( (y) => x.includes(y) ).length < 1;
                    return (containsIgnoredItem && this.rowData[x] != null && typeof this.rowData[x] !== 'object' && this.rowData[x] != "");
                });
            },
            modalId () {
                return `detail-row-${new Date().getTime()}`;
            }
        },

        filters: {
            capitalize(value) {
                return value.charAt(0).toUpperCase() + value.slice(1);
            },
            convertDataToText(value) {
                return value.replace("_"," ").replace(" id","");
            }
        },

        methods: {
            onClick(event) {

            },
            openModal (data) {
                for(let x in data) {
                    if(typeof data[x] == 'object' && data[x] !== null)
                        data[x+" name"] = (data[x].name);
                }
                this.rowData = data;
                window.$('#'+this.modalId).modal().modal('open');
            }
        },
    }
</script>

<style scoped>
    span.badge.new {
        font-size: initial;
    }
</style>