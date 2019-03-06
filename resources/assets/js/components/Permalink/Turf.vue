<template>
    <div class="container">
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card grey darken-3">
                    <div class="card-content">
                        <h3>
                            {{ data.name }}


                        </h3>
                        <p>
                            <span v-if="data.user.verified">
                                (Verified By Turf ASAP)
                            </span>
                        </p>
                        <div class="row">
                            <div class="col l8 m8 s12">
                                <vue-slider :data="imageSource" ref="slider"></vue-slider>

                            </div>
                            <div class="col l4 m4 s12">
                                <h5>Address</h5>
                                <p>{{ data.address }}</p>

                                <p><a target="_blank" :href="getMapsUrl(data.latitude, data.longitude)">Find On Maps <i class="material-icons">maps</i></a></p>

                                <h5>Provided By</h5>
                                <p> {{ data.user.name }} </p>

                                <h5>Pitch Type</h5>
                                <p> {{ data.type }} </p>

                                <h5>Capacity</h5>
                                <p> For {{ data.capacity }} People</p>

                                <h5>Opened</h5>
                                <p> From {{ data.from }} Hours to {{ data.to }} Hours</p>

                                <h5>Average Ratings</h5>
                                <p v-if="data.average_ratings"> {{ data.average_ratings }} stars from {{ data.ratings.length }} reviews </p>
                                <p v-else>Not yet rated</p>

                                <h5>Price</h5>
                                <p>₹{{ data.price }}</p>

                                <br>
                                <button @click="book()" class="btn blue waves-block waves-light" style="width: 100%;">Book Now</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l6 m6 s12">
                                <h5>Amenities</h5>
                                <ul class="collection with-header">
                                    <li class="collection-item grey darken-3" v-for="facility in data.facilities">
                                        {{ facility.facility }} <span class="right">{{ facility.value }}</span>
                                    </li>

                                </ul>

                            </div>
                            <div class="col l6 m6 s12">
                                <h5>Specifications</h5>
                                <ul class="collection with-header">
                                    <li class="collection-item grey darken-3">
                                        Dimensions
                                        <span class="right">
                                            {{ data.length }} ft. X {{ data.width }} ft.
                                        </span>
                                    </li>
                                    <li class="collection-item grey darken-3">
                                        Footwear Allowed
                                        <span class="right">
                                            {{ data.footwear }}
                                        </span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="row" v-if="!data.average_ratings">
                            <div class="col l12 m12 s12">
                                <h5>Be the first one to write a review</h5>
                                <a href="/getstarted"></a>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col l12 m12 s12">
                                <h5>Reviews</h5>
                                <ul class="collection">
                                    <li class="collection-item avatar black-text"  v-for="review in data.ratings">
                                        <img :src="review.user.image" alt="" class="circle">
                                        <span class="title">{{ review.user.name }}</span>
                                        <p>{{ review.comment }}</p>
                                        <a href="#!" class="secondary-content">{{ review.stars }}★</a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <div class="row" v-if="auth != 0">
                            <div class="col l12 m12 s12">
                                <p class="range-field">
                                    You rated {{ form.stars }} points!
                                    <input type="range" v-model="form.stars" min="1" max="5" />
                                </p>
                            </div>
                            <div class="col l11 m11 s11">
                                <input type="text" v-model="form.comment" placeholder="Write about your experience">
                            </div>
                            <div class="col l1 s1 m1">
                                <button class="btn black blue waves-effect waves-light btn-floating" @click="sendReview()" ><i class="material-icons">send</i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vueSlider from './Utils/VueSlider.vue'
    export default {
        props: ['url', 'turf', 'auth'],
        data() {
            return {
                data: {
                    user: {},

                },
                imageSource: [],
                form : {
                    comment : '',
                    stars : 3
                }
            }
        },
        components: {
            vueSlider
        },
        watch: {
          data(val) {
              if (typeof val.all_images_url != undefined) {
                  this.imageSource = val.all_images_url.map((x, y) => { return {id:y, src:x}})
                  this.$refs.slider.slides = this.imageSource
              }
          }
        },
        mounted() {
            this.data = this.turf;
            this.fetchData();

        },
        methods: {
            fetchData () {
                window.axios.get(this.url)
                    .then((response) => {
                        this.data = response.data;
                    })
                    .catch((e) => {
                        window.error(e);
                    });
            },
            book() {
                window.location.href = window.location.href + '/book'
            },
            getMapsUrl(lt, lg) {
                return `https://www.google.com/maps/?q=${lt},${lg}`
            },
            sendReview () {
                var data = this.form;
                window.axios.post(`/ajax/turfs/${this.data.id}/rate`, data)
                    .then( (r) => {
                        this.fetchData();
                        this.form = {comment:'', stars: 3}
                    })
            }
        }
    }
</script>
