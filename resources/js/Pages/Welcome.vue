<script>
import EmptyLayout from "@/Layouts/EmptyLayout.vue";

export default {
    layout: EmptyLayout
}
</script>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import {trans} from "../utils.js";
import WelcomeHero from "@/assets/images/welcomeHero.jpg";
import Welcome1 from "@/assets/images/welcome1.jpg";

</script>

<template>
    <div
        class="relative w-full h-screen bg-no-repeat bg-cover bg-center flex justify-center items-center"
        :style="{ backgroundImage: `url(${WelcomeHero})`}"
    >
        <div class="absolute inset-0" style="background-color: rgba(0, 0, 0, 0.5);"></div>


        <div class="absolute w-full z-10 top-0 flex justify-end gap-x-2 p-2">
            <Link :href="route('login')">
                <button class="border-2 border-transparent rounded-lg hover:border-white transition-all duration-200 py-2 px-5 text-white">{{trans('Login')}}</button>
            </Link>

            <button class="border-2 border-transparent rounded-lg hover:border-white transition-all duration-200 py-2 px-5 hover:text-white text-green-200">{{trans('Register')}}</button>
        </div>
        <div class="relative z-10 lg:min-w-[1000px] mx-auto text-white space-y-2 px-4">
            <p class="uppercase text-[12px] font-semibold">{{trans('we are experts')}}</p>
            <h1 class="text-5xl font-semibold">{{trans('Finpoint provides')}} <br> {{trans('Financial Consulting in')}} <br> {{trans('different ways')}}</h1>
            <p class=" py-4 text-md max-w-[500px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <button class="btn py-4 px-7 border border-white text-lg uppercase transition-all duration-200">{{trans('get started')}}</button>
        </div>
    </div>
    <div class="w-full py-[70px] bg-[#F7D0B6] p-4">
        <div class="max-w-[1000px] flex flex-col md:flex-row gap-4 justify-between items-center mx-auto">
            <div class=" max-w-[650px] space-y-4">
                <p class="text-[#082F49] font-semibold text-3xl">{{trans(`As the leading experts in this field, we're in over 90 countries`)}}</p>
                <p class="text-[#082F49] text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <button class="py-2 px-7 border text-lg uppercase transition-all hover:bg-[#DFC0AA] duration-200 border-black text-black">{{trans('get started')}}</button>
        </div>
    </div>

    <div class="py-12 w-full space-y-16 bg-white">
        <div class="grid grid-cols-6 md:grid-cols-12 w-full">
            <div class="col-span-6 w-full flex flex-col items-end justify-start gap-4 p-6 md:p-16">
                <p class="text-2xl font-semibold text-[#082F49] text-end">{{trans('Whether you need ')}}<br>{{ trans('Assistance') }}</p>
                <img class="max-w-[500px] w-full" :src="Welcome1" alt="">
            </div>
            <div class="col-span-6 w-full bg-[#082F49] flex flex-col items-start justify-between gap-y-2 p-6 md:p-16 text-white">
                <h1 class="text-5xl font-semibold max-w-[350px] leading-[70px] text-[#F7D0B6]">{{trans('Finpoint is here to help you')}}</h1>
                <p class="text-[15px] max-w-[450px] leading-6">Purus in massa tempor nec. Magna etiam tempor orci eu lobortis elementum nibh tellus molestie. Faucibus ornare suspendisse sed nisi lacus sed viverra. Diam in arcu cursus euismod quis viverra nibh cras pulvinar.</p>
                <button class="btn py-2 px-8 border text-md uppercase transition-all duration-200 border-white">{{trans('talk with expert')}}</button>
            </div>
        </div>

        <div class="grid grid-cols-6 md:grid-cols-12 w-full">
            <div class="col-span-6 w-full bg-[#F7D0B6] flex flex-col items-end justify-between gap-y-2 p-6 md:p-16 text-black">
                <h1 class="text-5xl font-semibold max-w-[450px] leading-[70px] text-[#082F49] text-start">{{trans('Finpoint is here to help you')}}</h1>
                <p class="text-[15px] max-w-[450px] leading-6">Purus in massa tempor nec. Magna etiam tempor orci eu lobortis elementum nibh tellus molestie. Faucibus ornare suspendisse sed nisi lacus sed viverra. Diam in arcu cursus euismod quis viverra nibh cras pulvinar.</p>
                <div class="max-w-[450px] w-full flex justify-start"><button class="btn py-2 px-8 border text-md uppercase transition-all duration-200 border-black">{{trans('talk with expert')}}</button></div>

            </div>
            <div class="col-span-6 w-full flex flex-col items-start justify-start gap-4 p-6 md:p-16">
                <p class="text-2xl font-semibold text-[#082F49] text-start">{{trans('Whether you need ')}}<br> {{trans('Assistance')}}</p>
                <img class="max-w-[500px] w-full" :src="Welcome1" alt="">
            </div>
        </div>

        <div class="grid grid-cols-6 md:grid-cols-12 w-full">
            <div class="col-span-6 w-full flex flex-col items-end justify-start gap-4 p-6 md:p-16">
                <p class="text-2xl font-semibold text-[#082F49] text-end">{{trans('Whether you need ')}}<br> {{trans('Assistance')}}</p>
                <img class="max-w-[500px] w-full" :src="Welcome1" alt="">
            </div>
            <div class="col-span-6 w-full bg-[#082F49] flex flex-col items-start justify-between gap-y-2 p-6 md:p-16 text-white">
                <h1 class="text-5xl font-semibold max-w-[350px] leading-[70px] text-[#F7D0B6]">{{trans('Finpoint is here to help you')}}</h1>
                <p class="text-[15px] max-w-[450px] leading-6">Purus in massa tempor nec. Magna etiam tempor orci eu lobortis elementum nibh tellus molestie. Faucibus ornare suspendisse sed nisi lacus sed viverra. Diam in arcu cursus euismod quis viverra nibh cras pulvinar.</p>
                <button class="btn py-2 px-8 border text-md uppercase transition-all duration-200 border-white">{{trans('talk with expert')}}</button>
            </div>
        </div>
    </div>
</template>

<style>
.btn:hover{
    background-color: rgba( 255, 255,255, 0.2);
}
</style>
