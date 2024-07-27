<script setup>
import KeyBoardDownArrowSvg from "@/assets/svg/KeyBoardDownArrowSvg.vue";
import {computed, onMounted, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import {languages} from "@/utils.js";
import axios from "axios";

const locale = usePage().props.locale;

const open = ref(false);
const selectedLanguage = computed(() => {
    return languages.find(lang => lang.locale === locale)
})

const setLocale = (locale) => {
    axios.post(route('set-locale', locale)).then(() => {
        window.location.reload();
    });
}

onMounted(() => {
    router.on('finish', () => {
        open.value = false
    })
})
</script>

<template>
    <div class="relative">
        <div class="flex items-center py-1 px-2 rounded-lg gap-x-3 shadow-xl border border-bodydark cursor-pointer" @click="open = true">
            <span v-html="selectedLanguage.svg"></span>
            <KeyBoardDownArrowSvg/>
        </div>

        <div v-show="open" class="fixed inset-0 z-10 h-screen w-screen" @click="open = false"></div>

        <div v-if="open" class="absolute z-20 top-12 right-0 flex flex-col gap-y-2 bg-white dark:bg-boxdark border border-bodydark rounded-lg py-2 text-black dark:text-white font-medium">
            <div
                v-for="(lang, index) in languages.filter(lang => lang.locale !== locale)"
                :key="index"
                @click="setLocale(lang.locale)"
                class="flex items-center gap-3 px-2 py-1 hover:bg-bodydark cursor-pointer"
            >
                <span v-html="lang.svg"></span>
                <p>{{lang.name}}</p>
            </div>
        </div>
    </div>
</template>
