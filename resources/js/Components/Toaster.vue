<script setup>
import {onMounted} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import { toast } from 'vue3-toastify';

onMounted(() => {
    router.on('finish', event => {
        let rtl = document.documentElement.dir !== 'ltr';
        const toastMessage = usePage().props.toastMessage;

        if (toastMessage) {
            toast[toastMessage.type](toastMessage.message, {
                autoClose: 2000,
                rtl: rtl
            })
        }
    })
})
</script>

<template>
</template>
