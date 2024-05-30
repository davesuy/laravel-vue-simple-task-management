import './bootstrap';

import { createApp } from "vue";

import App from './components/App.vue';
import TaskList from './components/TaskList.vue';

const app = createApp(App);

app.component('task-list', TaskList);

app.mount('#app')

