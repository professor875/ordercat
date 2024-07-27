<script setup>
import Table from "@/Components/Tables/Table.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import TableHeadRow from "@/Components/Tables/TableHeadRow.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableData from "@/Components/Tables/TableData.vue";
import EyeSvg from "@/assets/svg/light/EyeSvg.vue";
import {Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Tables/Pagination.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import {trans} from "@/utils.js";
import {Head} from "@inertiajs/vue3";

defineProps({
    contacts: Object
})

</script>

<template>
    <Head :title="trans('Contact')"/>

    <BreadcrumbDefault :pageTitle="trans('Contact')"/>

    <Link :href="route('contacts.create')">
        <PrimaryButton class="bg-success">{{ trans('Add') }}</PrimaryButton>
    </Link>

    <div class="flex flex-col gap-10 mt-4">
        <Table class=" border border-primary">
            <thead>
            <TableHeadRow>
                <TableHead>{{trans('#SR')}}</TableHead>
                <TableHead>{{ trans('Name') }}</TableHead>
                <TableHead>{{ trans('Type') }}</TableHead>
                <TableHead>{{ trans('Contact Channel') }}</TableHead>
                <TableHead>{{ trans('Action') }}</TableHead>
            </TableHeadRow>
            </thead>
            <tbody>
            <tr v-for="(contact, index) in contacts.data" :key="index">
                <TableData>{{ index + 1 }}</TableData>
                <TableData>{{ contact.name }}</TableData>
                <TableData>{{ trans(contact.type) }}</TableData>
                <TableData>{{ trans(contact.contact_channel) }}</TableData>
                <TableData>
                    <Link :href="route('contacts.show', contact.id)">
                        <button class="hover:text-primary">
                            <EyeSvg/>
                        </button>
                    </Link>
                </TableData>
            </tr>
            <tr v-show="contacts.data.length === 0">
                <TableData class="text-center italic text-xl row-span-3" :colspan="5" >No Records...</TableData>
            </tr>
            </tbody>
        </Table>

        <Pagination :links="contacts.links"/>
    </div>
</template>
