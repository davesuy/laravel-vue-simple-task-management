<template>
<div  class="max-w-xl w-full ">

    <div class="bg-white p-5 rounded-md shadow-lg">


        <form @submit.prevent="onSubmit" class="grid grid-cols-12 gap-2" v-if="updateTitle === ''">

            <div class="col-span-9">
                <input type="text" name="title" v-model="title" class="w-full p-2 border focus:outline-none focus:border-blue-200 focus:shadow-lg">
            </div>

            <div class="col-span-3">
                <input type="submit" name="submit" value="Add task" class="w-full p-2 bg-blue-400 text-white rounded-md font-medium hover:bg-sky-500 hover:cursor-pointer hover:font-semibold">
            </div>

        </form>

        <form @submit.prevent="onUpdateSubmit" class="grid grid-cols-12 gap-2" v-if="updateTitle !== ''">

            <div class="col-span-9">
                <input type="text" name="title" v-model="updateTitle" class="w-full p-2 border focus:outline-none focus:border-blue-200 focus:shadow-lg">

                <input type="hidden" name="taskId" v-model="UpdateTaskId">


            </div>

            <div class="col-span-3">
                <input type="submit" name="update" value="Update" class="w-full py-2 bg-blue-400 text-white rounded-md font-medium hover:bg-sky-500 hover:cursor-pointer hover:font-semibold">
            </div>

        </form>

    </div>

    <h1 class="font-bold text-lg py-3 text-white">Pending List</h1>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">#</th>
            <th scope="col" class="px-6 py-3">Description</th>
            <th scope="col" class="px-6 py-3">Action</th>
        </tr>
        </thead>
        <tbody>

        <template  v-for="task in tasks" :key="task.id"  >

            <tr v-if="task.completed === 0" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                <td class="px-6 py-4">{{ task.id }}</td>
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ task.title }}</td>
                <td class="px-6 py-4">

                    <button @click="completedFunc(task.id)" class="text-green-600 p-1">Mark as done</button>

                    <button @click="editFunc(task.title, task.id)" class="text-blue-300 p-1">Edit</button>

                    <button @click="deletedFunc(task.id)" class="text-red-600 p-1">Delete</button>


                </td>

            </tr>
        </template>


        </tbody>
    </table>


    <h1 class="font-bold text-lg py-3 text-white">Completed List</h1>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">#</th>
            <th scope="col" class="px-6 py-3">Description</th>
            <th scope="col" class="px-6 py-3">Action</th>
        </tr>
        </thead>
        <tbody>

        <template  v-for="task in tasks" :key="task.id"  >

            <tr v-if="task.completed === 1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                <td class="px-6 py-4">{{ task.id }} </td>
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ task.title }}</td>
                <td class="px-6 py-4">

                    <button @click="undoFunc(task.id)" class="text-green-600 p-1">Undo</button>

                    <button @click="editFunc(task.title, task.id)" class="text-blue-300 p-1">Edit</button>

                    <button @click="deletedFunc(task.id)" class="text-red-600 p-1">Delete</button>


                </td>

            </tr>
        </template>


        </tbody>
    </table>


</div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
import axios from 'axios';


const tasks = ref([]);
const title = ref('');
const updateTitle = ref('');
const UpdateTaskId = ref('');


onMounted(async () => {

    try {
        const response = await axios.get('/api/fetchTasks');
        tasks.value = response.data;

    } catch (error) {
        console.error('Failed to fetch tasks:', error);
    }


});

const onSubmit = async () => {
    try {
        await axios.post('/api/store', {
            title: title.value,
        });

        fetchNewData();

    } catch (error) {
        console.error('Error submitting form:', error);
    }
};

const onUpdateSubmit = async () => {


    try {

        await axios.post('/api/update/' + UpdateTaskId.value, {
            taskTitle: updateTitle.value
        });

        fetchNewData();

        updateTitle.value = '';

    } catch (error) {
        console.error('Error submitting form:', error);
    }
};


const completedFunc = async (id) => {
    try {

        await axios.post('/api/done/' + id);

        fetchNewData();

    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

const undoFunc = async (id) => {
    try {

        await axios.post('/api/undo/' + id);

        fetchNewData();

    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

const deletedFunc = async (id) => {
    try {

        await axios.post('/api/destroy/' + id);

        fetchNewData();


    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

const editFunc = async (title, taskId) => {

    updateTitle.value = title;
    UpdateTaskId.value = taskId;

};


const fetchNewData = async () => {
    const fetchNewData = await axios.get('/api/fetchTasks');

    tasks.value = fetchNewData.data;
};


</script>

