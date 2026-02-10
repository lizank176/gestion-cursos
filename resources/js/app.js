import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
// Change this:
import Courses from './components/Courses.vue';
import Students from './components/StudentList.vue';

const routes = [
    { path: '/', component: Courses },
    { path: '/students', component: Students }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

createApp(App).use(router).mount('#app');