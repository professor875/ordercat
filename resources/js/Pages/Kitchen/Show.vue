<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, router,} from "@inertiajs/vue3";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import Swal from "sweetalert2";
import {hasPermission, trans} from "../../utils.js";

const props = defineProps({
    kitchen: Object
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
            router.delete(route('kitchens.destroy', props.kitchen.id))
        }
    })
}
</script>

<template>
    <Head :title="trans('Kitchen')"/>
    <BreadcrumbDefault :pageTitle="trans('Kitchen')"/>

    <Link :href="route('kitchens.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Kitchen Detail')" class="mt-4 border-stroke dark:border-form-strokedark">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4.5 gap-x-96">
            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Title')}}:</h4>
                <p>{{kitchen.title}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Commercial Registration')}}:</h4>
                <p>{{kitchen.commercial_registration}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Location Coordinate')}}:</h4>
                <p>{{kitchen.location_coordinate}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('User')}}:</h4>
                <p>{{kitchen.user.name}}</p>
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-x-4">
            <Link  v-if="hasPermission('kitchen.edit')" :href="route('kitchens.edit', kitchen.id)">
                <PrimaryButton class="bg-warning">
                    {{trans('Edit')}}
                </PrimaryButton>
            </Link>

            <PrimaryButton  v-if="hasPermission('kitchen.delete')" class="bg-red" @click="destroy">
                {{trans('Delete')}}
            </PrimaryButton>
        </div>
    </DefaultCard>
</template>
