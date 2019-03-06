<template>
    <div class="row">
        <div class="input-field col l8 m12 s12">
            <i class="material-icons prefix">search</i>
            <input id="icon_prefix" type="text" v-model="filterText" class="roboto-slab validate" @keyup.enter="doFilter" :placeholder="placeholder">
        </div>
        <div class="col l4 m12 s12">
            <br class="hide-on-med-and-down" />
            <button class="btn cyan blue waves-effect waves-light" @click="doFilter">Go</button>
            <button class="btn white black-text waves-effect waves-light" @click="resetFilter">Reset</button>
        </div>
    </div>
</template>

<script>
    export default {

        data () {
            return {
                filterText: ''
            }
        },

        methods: {
            doFilter () {
                this.$emit('filter-set', this.filterText)
            },
            resetFilter () {
                this.filterText = '';
                this.$emit('filter-reset')
            }
        },

        props: ['placeholder']
    }
</script>