<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, router,} from "@inertiajs/vue3";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import Swal from "sweetalert2";
import {hasPermission, trans} from "@/utils.js";

const props = defineProps({
    contact: Object
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
            router.delete(route('contacts.destroy', props.contact.id))
        }
    })
}
</script>

<template>
    <Head :title="trans('Contact')"/>

    <BreadcrumbDefault :pageTitle="trans('Contact')"/>

    <Link :href="route('contacts.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Contact Detail')" class="mt-4 border-stroke dark:border-form-strokedark">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4.5 gap-x-10 lg:gap-x-20 xl:gap-x-80">
            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Name')}}:</h4>
                <p>{{contact.name}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Type')}}:</h4>
                <p>{{contact.type}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Contact Channel')}}:</h4>
                <p>{{contact.contact_channel}}</p>
            </div>

            <div v-if="contact.contact_channel === 'sms'" class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Sms')}}:</h4>
                <p>{{contact.sms}}</p>
            </div>

            <div v-if="contact.contact_channel === 'email'" class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Email')}}:</h4>
                <p>{{contact.email}}</p>
            </div>

            <div v-if="contact.contact_channel === 'whatsapp'" class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Whatsapp')}}:</h4>
                <p>{{contact.whatsapp}}</p>
            </div>

            <div v-if="contact.contact_channel === 'phone'" class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Phone')}}:</h4>
                <p>{{contact.phone}}</p>
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-x-4">
            <Link  v-if="hasPermission('contact.edit')" :href="route('contacts.edit', contact.id)">
                <PrimaryButton class="bg-warning">
                    {{trans('Edit')}}
                </PrimaryButton>
            </Link>

            <PrimaryButton  v-if="hasPermission('contact.delete')" class="bg-red" @click="destroy">
                {{trans('Delete')}}
            </PrimaryButton>
        </div>
    </DefaultCard>
</template>
