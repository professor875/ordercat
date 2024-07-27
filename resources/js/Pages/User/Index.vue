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
    users: Object
})

</script>

<template>
    <Head :title="trans('User')"/>

    <BreadcrumbDefault :pageTitle="trans('User')"/>

    <Link :href="route('users.create')">
        <PrimaryButton class="bg-success">{{ trans('Add') }}</PrimaryButton>
    </Link>

    <div class="flex flex-col gap-10 mt-4">
        <Table class=" border border-primary">
            <thead>
            <TableHeadRow>
                <TableHead>{{trans('#SR')}}</TableHead>
                <TableHead>{{ trans('Name') }}</TableHead>
                <TableHead>{{ trans('Email') }}</TableHead>
                <TableHead>{{ trans('Contact Channel') }}</TableHead>
                <TableHead>{{ trans('Contact Number') }}</TableHead>
                <TableHead>{{ trans('User Roles') }}</TableHead>
                <TableHead>{{ trans('Action') }}</TableHead>
            </TableHeadRow>
            </thead>
            <tbody>
            <tr v-for="(user, index) in users.data" :key="index">
                <TableData>{{ index + 1 }}</TableData>
                <TableData>{{ user.name }}</TableData>
                <TableData>{{ user.email }}</TableData>
                <TableData>{{ user.contact_channel }}</TableData>
                <TableData>{{ user.contact_number }}</TableData>
                <TableData>{{user.roles.join(', ')}}</TableData>
                <TableData>
                    <Link :href="route('users.show', user.id)">
                        <button class="hover:text-primary">
                            <EyeSvg/>
                        </button>
                    </Link>
                </TableData>
            </tr>
            <tr v-show="users.data.length === 0">
                <TableData class="text-center italic text-xl row-span-3" :colspan="6" >No Records...</TableData>
            </tr>
            </tbody>
        </Table>

        <Pagination :links="users.links"/>
    </div>
</template>
