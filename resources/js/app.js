/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 
 import { Errors, Form } from 'vform';
 
 window.Form = Form;
 
 import { createRouter, createWebHistory } from 'vue-router';

 import Dashboard from './components/Dashboard.vue';
 import Task from './components/Task.vue';
 import Project from './components/Project.vue';

 let routes = [
     {
         path: '/',
         component: Dashboard
     },
     {
         path: '/task',
         component: Task
     },
     {
         path: '/project',
         component: Project
     },
 ];
 
 const router = createRouter({
    history: createWebHistory(''),
    routes: routes,
    linkActiveClass: 'active'
});

  const app = Vue.createApp({});

  app.use(router);

  app.mount('#wrapper');
 