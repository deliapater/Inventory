require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//Router Imported
import {routes} from './routes';

//Import User class
import User from './helpers/User';
window.User = User

//Import Notification class
import Notification from './helpers/Notification';
window.Notification = Notification

//Sweet alert start
import Swal from 'sweetalert2/dist/sweetalert2.js'
// window.Swal = Swal;
window.swal = require('sweetalert2');
import swal from 'sweetalert2';
window.Swal = swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
window.Toast = Toast;
//Sweet alert end

window.Reload = new Vue();

const router = new VueRouter({
    routes,
    mode: 'history'
  })
  


const app = new Vue({
    el: '#app',
    router
});
