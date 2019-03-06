<template>
    <div class="container" >
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card grey darken-3">
                    <div class="card-content">
                        <h3>
                            Enter your payment details
                        </h3>
                        <div class="row">
                            <div class="col l6 m6 s12">
                                <div class='card-wrapper'></div>
                            </div>
                            <div class="col l6 m6 s12">
                                <form id="card">
                                    <input type="text" class="validate" placeholder="Enter Card Number" name="number" v-model="f.number">
                                    <input type="text" class="validate" placeholder="Enter Name" name="name" v-model="f.name"/>
                                    <input type="text" class="validate" placeholder="Enter Expiry Date" name="expiry" v-model="f.expiry"/>
                                    <input type="text" class="validate" placeholder="Enter CVC" name="cvc" v-model="f.cvc"/>
                                </form>
                            </div>
                        </div>
                        <div class="row right-align">
                            <button class="btn blue" @click="submit">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['turf'],
        data() {
            return {
                f: {
                    number : '',
                    name : '',
                    expiry : '',
                    cvc : ''
                }
            }
        },
        mounted() {
            var card = new Card({
                form: 'form',
                container: '.card-wrapper',

            });

        },
        methods: {
            submit () {
                var data = {
                    card_number: this.f.number,
                    expiry_month: this.f.expiry.split("/")[0],
                    expiry_year: this.f.expiry.split("/")[1],
                    cvv: this.f.cvc
                    };
                window.NProgress.start();
                axios.post('/ajax/turfs/book', data)
                    .then((r) => {
                        window.NProgress.done();
                        if (r.data.success) {
                            window.success("Hey, turf booked successfully!");
                            window.location.href = "/home";
                        } else {
                            window.error(r.data.error)
                        }

                    }).catch((e) => window.error(e));
            }
        }
    }
</script>
