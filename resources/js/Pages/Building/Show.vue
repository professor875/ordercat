<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, router,} from "@inertiajs/vue3";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import Swal from "sweetalert2";
import {hasPermission, trans} from "../../utils.js";

const props = defineProps({
    building: Object
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
            router.delete(route('buildings.destroy', props.building.id))
        }
    })
}
</script>

<template>
    <Head :title="trans('Building')"/>

    <BreadcrumbDefault :pageTitle="trans('Building')"/>

    <Link :href="route('buildings.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Kitchen Detail')" class="mt-4 border-stroke dark:border-form-strokedark">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4.5 gap-x-96">
            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Title')}}:</h4>
                <p>{{building.title}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Type')}}:</h4>
                <p>{{building.type}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Inhabitants Count')}}}:</h4>
                <p>{{building.inhabitants_count}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Location Coordinate')}}:</h4>
                <p>{{building.location_coordinate}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('User')}}:</h4>
                <p>{{building.user ? building.user.name : '...'}}</p>
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-x-4">
            <Link  v-if="hasPermission('building.edit')" :href="route('buildings.edit', building.id)">
                <PrimaryButton class="bg-warning">
                    {{trans('Edit')}}
                </PrimaryButton>
            </Link>

            <PrimaryButton  v-if="hasPermission('building.delete')" class="bg-red" @click="destroy">
                {{trans('Delete')}}
            </PrimaryButton>
        </div>
    </DefaultCard>
</template>
