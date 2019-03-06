<template>
    <div class="col l4 m6 s12">
        <transition name="fade">
            <div class="card grey darken-3 z-depth-3" v-show="show">
                <div class="card-image activator waves-effect waves-block waves-light" >
                    <img class="activator" :class="{ 'pointer':isDescriptionAvailable}" :src="thumbnail" @load="show = true" >
                    <span class="activator card-title">
                        <span class="truncate">{{ cardData.name }}</span>

                    </span>

                </div>

                <div class="card-reveal" v-if="isDescriptionAvailable">
                    <span class="card-title grey-text text-darken-4">{{ cardData.name }}<i class="material-icons " style="float: right !important">close</i></span>
                    <p class="description-text black-text">{{ cardData.address }}</p>
                </div>

                <div class="card-action">
                    <a :href="cardData.permalink" class="white-text">Book Now</a>
                </div>
            </div>

        </transition>

        <div class="progress-wrapper " v-if="!show">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                show : false
            }
        },
        props : {
            cardData : {
                type : Object,
                required : true
            }
        },
        computed : {
            isDescriptionAvailable () {
                let address = this.cardData.address;
                return address != '' && typeof address == 'string';
            },
            defaultThumbnail () {
                return 'https://storage.googleapis.com/material-design/publish/material_v_11/assets/0Bx4BSt6jniD7VG9DQVluOFJ4Tnc/materialdesign_principles_metaphor.png'
            },
            thumbnail () {
                return this.cardData.all_images_url[0];
            }
        },
        methods : {
            onClick () {
                this.$parent.$parent.$emit('select-button-clicked', this.cardData);
            }
        }
    }

</script>

<style scoped>

    .progress-wrapper  {
        min-height: 250px !important;
        transform: translate(50%, 50%);
    }

    .progress-wrapper .preloader-wrapper {
        position: absolute;
        margin: 0 auto;
    }

    .upward-arrow {
        position: absolute;
        right: 10px;
        bottom: 0px;
    }
    .image-overlay {
        position: absolute;
        left: 50%;
        cursor: pointer;
    }
    .description-text {
        /*word-break: break-all !important;*/
        width: 100%;
        /*text-align: justify;*/
        -webkit-hyphens: auto;
        -moz-hyphens: auto;
        -ms-hyphens: auto;
        hyphens: auto;
        overflow: hidden !important;
    }


    .card-image {
        margin: 0 auto;
        display: block;
        max-height: 232px;
        width: 1px;
        max-width: 100%;
        min-width: 100%;
    }

    .image-container {

    }

    .image-container:hover .overlay {
        opacity: 1;
    }

    .image-container:hover .card-image {
        filter: blur(5px);
    }

</style>