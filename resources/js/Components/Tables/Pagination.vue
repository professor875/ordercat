<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    links: Array
})
</script>

<template>
    <div class="w-full mt-4" v-if="links.length > 3">
        <div class="flex justify-center -mb-1">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null || link.active" :key="key"
                     class="px-4 py-3 mb-1 mr-3 text-sm leading-4 text-gray-400 dark:text-black border rounded" :class="{'bg-white': link.active}" v-html="link.label"/>
                <Link v-else class="px-4 py-3 mb-1 mr-3 text-sm leading-4 border rounded hover:bg-white dark:hover:text-black focus:border-indigo-500 focus:text-indigo-500"
                      :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label"/>
            </template>
        </div>
    </div>
</template>

<style scoped>

</style>
