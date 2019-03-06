import jQuery from 'jquery';
import Vue from 'vue';
import VeeValidate from 'vee-validate';
import Axios from 'axios';
import notie from 'notie'
import NProgress from 'nprogress';
import 'materialize-css';

import '../cards/card.js'
// import '../cards/jquery.card.js'


global.$ = global.jQuery = jQuery;

// M.AutoInit();
window.Vue = Vue;
window.Vue.use(VeeValidate, { fieldsBagName: 'formFields'} );

window.axios = Axios;

// import Vuetify from 'vuetify';

// Vue.use(Vuetify);


window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};

window.NProgress = NProgress;
window.NProgress.configure({ showSpinner: false });

window.notie = notie;
window.success = (message) => {
    window.notie.alert({
        text: message,
        type: 'success'
    });
};
window.error = (message) => {
    window.notie.alert({
        text: message,
        type: 'error'
    });
};
window.info = (message) => {
    window.notie.alert({
        text: message,
        type: 'info'
    });
};