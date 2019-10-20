require('./bootstrap');

// Vue import
import Vue from 'vue'

// Vuetify settings
import Vuetify from 'vuetify'
Vue.use(Vuetify)
const vuetifyOpts = {

}

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('menus', require('./components/Menus.vue').default);
Vue.component('ingredients-index', require('./components/Pages/Ingredients/Index.vue').default);
Vue.component('measurements-index', require('./components/Pages/Measurements/Index.vue').default);
Vue.component('users-index', require('./components/Pages/Users/Index.vue').default);
// Vue.component('users-index', require('./components/Pages/Users/Index.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(vuetifyOpts)
});
