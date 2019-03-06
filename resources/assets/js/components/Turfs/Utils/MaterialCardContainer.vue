<template>
    <div class="row">

        <transition-group name="flip-list" tag="div">
            <div v-for="(card, index) in cardArray" v-bind:key="index" class="">
                <material-card
                        :card-data="card"

                ></material-card>
            </div>

        </transition-group>
    </div>

</template>

<script>
    import materialCard from './MaterialCard.vue'
    export default {
        components: {materialCard},
        data () {
            return {
                cardArray : []
            }
        },
        props : {
            apiUrl : {
                type : String,
                default () {
                    return ''
                }
            },
        },
        mounted () {
            if (this.apiUrl != '') {
                this.fetchData();
            }
        },
        methods : {
            fetchData () {
                let url = this.apiUrl;
                window.NProgress.start();
                window.axios.get(url)
                    .then( (response) => {
                        window.NProgress.done();
                        this.cardArray = response.data.data;
                        this.$parent.cardArray = this.cardArray;
                    })
                    .catch( (error) => {
                        window.logError(error);
                    })
            },


        }


    }
</script>

<style scoped>
    .icon-ded {
        content : url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJAAAACQAQMAAADdiHD7AAAABlBMVEUAAABTU1OoaSf/AAAAAXRSTlMAQObYZgAAAFJJREFUeF7t0cENgDAMQ9FwYgxG6WjpaIzCCAxQxVggFuDiCvlLOeRdHR9yzjncHVoq3npu+wQUrUuJHylSTmBaespJyJQoObUeyxDQb3bEm5Au81c0pSCD8HYAAAAASUVORK5CYII=);
    }
</style>