
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



import Footer from './components/Footer.vue'
import Toolbar from './components/Toolbar.vue'

import Turfs from './components/Turfs/Container.vue'
import Permalink from './components/Permalink/Turf.vue'
import Book from './components/Booking/Book.vue'
import Payment from './components/Payment/Confirm.vue'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('my-vuetable', require('./components/utils/vuetable/components/MyVuetable.vue'));
Vue.component('upload-image-modal', require('./components/utils/modals/ImageUploadModal.vue'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('foot', Footer);
Vue.component('toolbar', Toolbar);
Vue.component('turfs', Turfs);
Vue.component('permalink', Permalink);
Vue.component('book', Book);
Vue.component('payment', Payment);

const app = new Vue({
    el: '#app'
});

