<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, router,} from "@inertiajs/vue3";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import Swal from "sweetalert2";
import {hasPermission, trans} from "@/utils.js";

const props = defineProps({
    item: Object
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
            router.delete(route('items.destroy', props.item.id))
        }
    })
}
</script>

<template>
    <Head :title="trans('Item')"/>

    <BreadcrumbDefault :pageTitle="trans('Item')"/>

    <Link :href="route('items.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Item Detail')" class="mt-4 border-stroke dark:border-form-strokedark">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4.5 gap-x-10 lg:gap-x-20 xl:gap-x-80">
            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Title')}}:</h4>
                <p>{{item.title}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Description')}}:</h4>
                <p>{{item.description}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Days')}}:</h4>
                <p>{{item.days.join(', ')}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Types')}}:</h4>
                <p>{{item.types.join(', ')}}</p>
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-x-4">
            <Link  v-if="hasPermission('item.edit')" :href="route('items.edit', item.id)">
                <PrimaryButton class="bg-warning">
                    {{trans('Edit')}}
                </PrimaryButton>
            </Link>

            <PrimaryButton  v-if="hasPermission('item.delete')" class="bg-red" @click="destroy">
                {{trans('Delete')}}
            </PrimaryButton>
        </div>
    </DefaultCard>
</template>
