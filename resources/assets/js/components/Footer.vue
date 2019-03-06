<template>
    <!--<v-footer
            dark
            height="auto"
    >
        <v-card
                class="flex"
                flat
                tile
        >
            <v-card-title class="grey darken-3">
                <strong class="subheading">Get connected with us on social networks!</strong>

                <v-spacer></v-spacer>

                <v-btn
                        v-for="icon in icons"
                        :key="icon"
                        class="mx-3"
                        dark
                        icon
                >
                    <v-icon size="24px">{{ icon }}</v-icon>
                </v-btn>
            </v-card-title>

            <v-card-actions class="black justify-center">
                &copy;{{ year }} — <strong>{{ name }}</strong>
            </v-card-actions>
        </v-card>
    </v-footer>-->
    <footer class="page-footer grey darken-3">
        <div class="container ">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">
                        Contact Us
                    </h5>
                    <p class="grey-text text-lighten-4">
                        Need Any Help? Get in our touch now!
                    </p>
                    <p class="grey-text text-lighten-4">
                        <i class="fa fa-phone"></i> 8000-TURF-ASAP

                    </p>
                    <p class="grey-text text-lighten-4">
                        <i class="fa fa-globe"></i> support@turfasap.io

                    </p>
                </div>
                <div class="col l3 offset-l3 s12">
                    <h5 class="white-text">Links</h5>
                    <div class="footer-icons">
                        <a class="white-text icon" v-for="icon in icons"> <i :class="icon"></i></a>

                    </div>
                    <div class="white-text">
                        <a href="/about">About Us</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright black">
            <div class="container">
                © {{ year }} {{ name }}
                <a target="_blank" class="grey-text text-lighten-4 right" href="https://docs.google.com/forms/d/e/1FAIpQLSfue93imI5WgVafPA-FCdhA0CYt8jHVngLe8Pd6WwHJnzXdgw/viewform?usp=sf_link">Feedback About Us</a>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        props : ['name'],
        data: () => ({
            icons: [
                'fab fa-facebook',
                'fab fa-twitter',
                'fab fa-google-plus',
                'fab fa-linkedin',
                'fab fa-instagram'
            ]
        }),
        computed : {
            year : () => (new Date).getFullYear()
        }
    }
</script>

