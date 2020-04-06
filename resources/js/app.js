require('./bootstrap');
window.Vue = require('vue');

Vue.component('table-component', require('./components/TableComponent.vue').default);
Vue.component('tabs-component', require('./components/TabsComponent.vue').default);
const app = new Vue({
    el: '#app',
});
