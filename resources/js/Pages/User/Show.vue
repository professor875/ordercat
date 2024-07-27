<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, router,} from "@inertiajs/vue3";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import Swal from "sweetalert2";
import {hasPermission, trans} from "@/utils.js";

const props = defineProps({
    user: Object
})

const destroy = () => {
    Swal.fire({
        title: trans('Delete!'),
        text: trans('Are you sure want to delete?'),
        icon: trans('question'),
        confirmButtonText: trans('Yes'),
        cancelButtonText: trans('No'),
        showCancelButton: true,
    }).then(result => {
        if (result.isConfirmed) {
            router.delete(route('users.destroy', props.user.id))
        }
    })
}
</script>

<template>
    <Head :title="trans('User')"/>

    <BreadcrumbDefault :pageTitle="trans('User')"/>

    <Link :href="route('users.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('User Detail')" class="mt-4 border-stroke dark:border-form-strokedark">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4.5 gap-x-10 lg:gap-x-20 xl:gap-x-80">
            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Name')}}:</h4>
                <p>{{user.name}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Email')}}:</h4>
                <p>{{user.email}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Contact Channel')}}:</h4>
                <p>{{user.contact_channel}}</p>
            </div>

            <div v-if="user.contact_channel !== 'email'" class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Contact Number')}}:</h4>
                <p>{{user.contact_number}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('User Role')}}:</h4>
                <div v-for="(role, index) in user.roles" class="flex gap-3">
                    <p :key="index">{{role}}</p>
                </div>
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-x-4">
            <Link  v-if="hasPermission('user.edit')" :href="route('users.edit', user.id)">
                <PrimaryButton class="bg-warning">
                    {{trans('Edit')}}
                </PrimaryButton>
            </Link>

            <PrimaryButton  v-if="hasPermission('user.delete')" class="bg-red" @click="destroy">
                {{trans('Delete')}}
            </PrimaryButton>
        </div>
    </DefaultCard>
</template>
