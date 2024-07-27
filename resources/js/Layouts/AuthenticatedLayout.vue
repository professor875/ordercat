<script setup>
import HeaderArea from "@/Components/Header/HeaderArea.vue";
import SidebarArea from "@/Components/Sidebar/SidebarArea.vue";
import Toaster from "@/Components/Toaster.vue";
import {onMounted} from "vue";
import {languages} from "@/utils.js";
import {usePage} from "@inertiajs/vue3";

const locale = usePage().props.locale;
const selectedLang = languages.find(lang => lang.locale === locale)

const handleDarkMode = () => {
    const isDarkMode = localStorage.getItem('darkMode') === 'true' ?? false;

    if (isDarkMode) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
}

const handleLanguage = () => {
    document.documentElement.lang = selectedLang.locale;
    document.documentElement.dir = selectedLang.dir;
}

onMounted(() => {
    handleDarkMode();
    handleLanguage()
})
</script>

<template>
    <Toaster/>
    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <SidebarArea />
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Header Start ===== -->
            <HeaderArea />
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-8">
                    <slot></slot>
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
    </div>
    <!-- ===== Page Wrapper End ===== -->
</template>
