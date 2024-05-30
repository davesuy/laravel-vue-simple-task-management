<template>

    <div class="min-h-screen w-screen bg-gradient-to-bl from-indigo-500 to-purple-500 flex flex-col gap-2 items-center justify-center p-5">
        <h1 class="text-2xl text-white font-bold">Laravel Vue Simple Task Management</h1>

        <TaskList />

    </div>

</template>

<script>

import {defineComponent} from "vue";
import TaskList from "./TaskList.vue";

export default defineComponent({
    components: {
        TaskList,
    }
});

</script>
