<template>
    <div class="container">
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card grey darken-3">
                    <div class="card-content">
                        <h3>
                            Booking Summary
                        </h3>

                        <div class="row">
                            <div class="col l6 m6 s12">
                                <h5>Name</h5>
                                <p>{{ data.name }}</p>
                            </div>

                            <div class="col l6 m6 s12">

                                <h5>Address</h5>
                                <p>{{ data.address }}</p>
                            </div>
                            <div class="col l6 m6 s12">
                                <h5>Pitch Type</h5>
                                <p> {{ data.type }} </p>
                            </div>
                            <div class="col l6 m6 s12">
                                <h5>Footwear Type</h5>
                                <p> {{ data.footwear }} </p>
                            </div>
                            <div class="col l6 m6 s12">
                                <h5>Capacity</h5>
                                <p> For {{ data.capacity }} People</p>
                            </div>
                            <div class="col l6 m6 s12">
                                <h5>Opened</h5>
                                <p> From {{ data.from }} Hours to {{ data.to }} Hours</p>
                            </div>
                            <div class="col l6 m6 s12">

                                <h5>Average Ratings</h5>
                                <p v-if="data.average_ratings"> {{ data.average_ratings }} stars from {{ data.ratings.length }} reviews </p>
                                <p v-else>Not yet rated</p>

                            </div>
                            <div class="col l6 m6 s12">
                                <h5>Price</h5>
                                <p>₹{{ data.price }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col l4 m4 s4">
                                <input type="date" class="white-text" v-model="selectedDate" placeholder="Pick a date">
                            </div>
                            <div class="col l4 m4 s4 register">
                                <select name="starttime" id="starttime" class="browser-default" v-model="starttime">
                                    <option :value="hour" v-for="hour in hours"> {{ hour }}</option>
                                </select>
                            </div>
                            <div class="col l4 m4 s4 register">
                                <select name="totaltime" id="totaltime" class="browser-default" v-model="totaltime">
                                    <option :value="hour" v-for="hour in remainingHours"> {{ hour }}</option>
                                </select>
                            </div>
                        </div>

                        <!--<div class="row" v-if="isDateSelected">-->
                            <!--<div :class="[selection.filter((x) => {x==hour}).length > 0 || isSelected[hour] == true ? 'green' : 'black', 'col l1 m1 s1 block']" v-for="hour in hours" @click="select(hour)">{{ hour }}</div>-->
                        <!--</div>-->
                        <div class="row right-align">
                            <div class="l2 m2 s4">
                                <h4>Grand Total</h4>
                                <h5>₹{{ price }}</h5>
                            </div>
                        </div>

                        <div class="row right-align" v-show="isDateSelected">
                            <button class="btn blue flat" @click="sendData"> Submit </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['url', 'turf'],
        data() {
            return {
                data: {},
                hours: [...Array(24).keys()],
                selection: [],
                dummy: false,
                isSelected: [...Array(24).keys()].map((x) => false),
                selectedDate: '',
                starttime: 0,
                totaltime: 0
            }
        },
        mounted() {
            this.data = this.turf;
            this.fetchData();

        },
        computed: {
            isDateSelected () {
                return new Date(this.selectedDate).getTime() > new Date().getTime()
            },
            remainingHours () {
                var a = this.starttime;
                return [...Array(24-a).keys()]
            },
            price () {
                return this.totaltime * this.data.price
            }
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
            select (elem) {
                if (this.isSelected[elem]) {
                    this.selection = this.selection.filter(x => x!=elem);
                    this.isSelected[elem] = false;
                } else {
                    this.selection.push(elem);
                    this.isSelected[elem] = true;

                }
                this.dummy = !this.dummy;
            },
            sendData () {
                var data = {
                    startdate: this.selectedDate,
                    starttime: this.starttime,
                    totaltime: this.totaltime,
                    amount: this.price
                };

                window.axios.post(`/ajax/turfs/${this.data.id}/validate`, data)
                    .then((response) => {
                        if (response.data.success) {
                            window.location.href = `/turfs/${this.data.id}/payment`
                        } else {
                            window.error(response.data.error)
                        }
                    }).catch((r) => window.error(r));
            }
        }
    }
</script>

<style scoped>
    .block {
        border: 1px solid white;

    }
</style>