
<script setup>
import {trans} from "@/utils.js";
defineProps({
    count: Number,
    label: String,
    icon: Object
})
</script>

<template>
    <div class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
        <Component :is="icon" width="50" height="50"/>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">{{ count }}</h4>
                <span class="text-sm font-medium">{{ trans(label) }}</span>
            </div>
        </div>
    </div>
</template>
