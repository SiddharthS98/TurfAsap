<template>
    <div class="slider-wrapper">
        <div class="slider-overflow">
            <div v-for="(slide,index) in slides"
                 v-assign-image="slide"
                 :slideId="index"
                 :prevSlide="prevSlide"
                 class="slide slide-transition"
                 v-show-slide="currentSlide"
            >
            </div>
            <div class="slider-controls">
                <div @click="changeSlidePrev" class="slider-control slider-control-prev"></div>
                <div @click="changeSlideNext" class="slider-control slider-control-next"></div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props:['data'],

        data: function data() {
            return {
                slides: this.data,
                currentSlide: 0
            };
        },
        mounted(){
            this.changeSlideNext();


            setInterval(() => {
                this.changeSlideNext();
            }, 5000);
        },
        computed: {
            prevSlide() {
                if (this.currentSlide == 0) return this.slides.length - 1;
                return this.currentSlide - 1;
            },
            nextSlide() {
                if (this.currentSlide == this.slides.length - 1) return 0;
                return this.currentSlide + 1;
            }
        },
        methods: {
            changeSlideNext () {
                if (this.currentSlide == this.slides.length - 1) {
                    this.currentSlide = 0;
                } else this.currentSlide++;
            },
            changeSlidePrev() {
                if (this.currentSlide == 0) {
                    this.currentSlide = this.slides.length - 1;
                } else this.currentSlide -= 1;
            }
        },
        directives: {
            "assign-image" : {
                update(el, slide, vnode) {

                    let img = slide.value;
//                    console.log(slide.value.src);

                    el.style.backgroundImage = "url("+img.src+")"
                }
            },
            "show-slide" : {
                update(el,current,vnode) {
                    let params = vnode.data.attrs;
                    let slideId = params.slideId;
                    let prevSlide = params.prevSlide;
                    if(current.value == slideId) {
                        el.style.opacity = 1;
                        el.className = "slide current-slide";
                    }
                    else if(slideId == prevSlide){
                        el.style.opacity = 0;
                        el.className = "slide previous-slide"
                    }
                    else {
                        el.style.opacity = 0;
                        el.className = "slide next-slide"
                    }
                }
            }
        }
    }
</script>

<style scoped>
    .slider-wrapper {
        width: 100%;
        height: 600px;
        background: #ccc;
        position: relative;
        overflow: hidden;
    }
    .slider-wrapper .slide {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position-x: 50%;
        background-position-y: 50%;
        -webkit-transition: opacity 1.1s ease, -webkit-transform 1s ease-out;
        transition: opacity 1.1s ease, -webkit-transform 1s ease-out;
        transition: opacity 1.1s ease, transform 1s ease-out;
        transition: opacity 1.1s ease, transform 1s ease-out, -webkit-transform 1s ease-out;
        position: absolute;
    }
    .slider-wrapper .slider-controls {
        width: 100%;
        position: absolute;
        top: 45%;
        z-index: 2;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }
    .slider-wrapper .slider-control {
        width: 50px;
        height: 50px;
        opacity: 0.4;
    }
    .slider-wrapper .slider-control-prev {
        background-image: url("https://cdn3.iconfinder.com/data/icons/faticons/32/arrow-right-01-512.png");
    }
    .slider-wrapper .slider-control-next {
        background-image: url("https://cdn3.iconfinder.com/data/icons/faticons/32/arrow-right-01-512.png");
    }

    .slider-wrapper .slider-control {
        -webkit-transition: opacity 0.3s ease;
        transition: opacity 0.3s ease;
    }
    .slider-wrapper .slider-control:hover {
        opacity: 0.8;
    }
    .slider-wrapper .current-slide {
        -webkit-transition: -webkit-transform 1s ease-out;
        transition: -webkit-transform 1s ease-out;
        transition: transform 1s ease-out;
        transition: transform 1s ease-out, -webkit-transform 1s ease-out;
        -webkit-transform: translateX(0);
        transform: translateX(0);
        z-index: 1;
    }
    .slider-wrapper .previous-slide {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
    }
    .slider-wrapper .next-slide {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
    }
</style>