<script setup>
import {trans} from "@/utils.js";
import Table from "@/Components/Tables/Table.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import TableHeadRow from "@/Components/Tables/TableHeadRow.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableData from "@/Components/Tables/TableData.vue";
import EyeSvg from "@/assets/svg/light/EyeSvg.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import {Head, Link} from "@inertiajs/vue3";


defineProps({
    roles: Object
})

</script>
<template>
    <Head :title="trans('Role')"/>
    <BreadcrumbDefault :pageTitle="trans('Role')" />

    <Link :href="route('roles.create')"><PrimaryButton class="bg-success">{{trans('Add')}}</PrimaryButton></Link>

    <div class="flex flex-col gap-10 mt-4">
        <Table class=" border border-primary">
            <thead>
            <TableHeadRow>
                <TableHead>{{trans('#SR')}}</TableHead>
                <TableHead>{{trans('Name')}}</TableHead>
                <TableHead>{{trans('Action')}}</TableHead>
            </TableHeadRow>
            </thead>
            <tbody>
            <tr v-for="(role, index) in roles.data" :key="index">
                <TableData>{{index + 1}}</TableData>
                <TableData>{{role.name}}</TableData>
                <TableData>
                    <Link :href="route('roles.show', role.id)">
                        <button class="hover:text-primary">
                            <EyeSvg/>
                        </button>
                    </Link>
                </TableData>
            </tr>
            <tr v-show="roles.data.length === 0">
                <TableData class="text-center italic text-xl row-span-3" :colspan="3" >No Records...</TableData>
            </tr>
            </tbody>
        </Table>

        <Pagination :links="roles.links"/>
    </div>
</template>
