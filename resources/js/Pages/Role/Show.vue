<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, router,} from "@inertiajs/vue3";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import Swal from "sweetalert2";
import {hasPermission, trans} from "@/utils.js";

const props = defineProps({
    role: Object
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
            router.delete(route('roles.destroy', props.role.id))
        }
    })
}
</script>

<template>
    <Head :title="trans('Role')"/>

    <BreadcrumbDefault :pageTitle="trans('Role')"/>

    <Link :href="route('roles.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Role Detail')" class="mt-4 border-stroke dark:border-form-strokedark">
        <div class="flex justify-between roles-center">
            <h4 class="text-black dark:text-white">{{trans('Name')}}:</h4>
            <p>{{role.name}}</p>
        </div>

        <h4>Permissions:</h4>

        <div class="col-span-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-x-6">
            <p v-for="(permission, index) in role.permissions" :key="index">{{permission.display_name}}</p>
        </div>

        <div class="mt-4 flex justify-end gap-x-4">
            <Link  v-if="hasPermission('role.edit')" :href="route('roles.edit', role.id)">
                <PrimaryButton class="bg-warning">
                    {{trans('Edit')}}
                </PrimaryButton>
            </Link>

            <PrimaryButton  v-if="hasPermission('role.delete')" class="bg-red" @click="destroy">
                {{trans('Delete')}}
            </PrimaryButton>
        </div>
    </DefaultCard>
</template>
