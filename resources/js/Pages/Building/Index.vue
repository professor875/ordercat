<script setup>
import Table from "@/Components/Tables/Table.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import TableHeadRow from "@/Components/Tables/TableHeadRow.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableData from "@/Components/Tables/TableData.vue";
import EyeSvg from "@/assets/svg/light/EyeSvg.vue";
import {Head, Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Tables/Pagination.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import {trans} from "../../utils.js";

defineProps({
    buildings: Object
})

</script>

<template>
    <Head :title="trans('Building')"/>
    <BreadcrumbDefault :pageTitle="trans('Building')" />

    <Link :href="route('buildings.create')"><PrimaryButton class="bg-success">{{trans('Add')}}</PrimaryButton></Link>

    <div class="flex flex-col gap-10 mt-4">
        <Table class="border-primary">
            <thead>
            <TableHeadRow>
                <TableHead>{{trans('#SR')}}</TableHead>
                <TableHead>{{trans('Title')}}</TableHead>
                <TableHead>{{trans('Type')}}</TableHead>
                <TableHead>{{trans('Inhabitants_count')}}</TableHead>
                <TableHead>{{trans('Location Coordinate')}}</TableHead>
                <TableHead>{{trans('User')}}</TableHead>
                <TableHead>{{trans('Action')}}</TableHead>
            </TableHeadRow>
            </thead>
            <tbody>
                <tr v-for="(building, index) in buildings.data" :key="index">
                    <TableData>{{index + 1}}</TableData>
                    <TableData>{{building.title}}</TableData>
                    <TableData>{{trans(building.type)}}</TableData>
                    <TableData>{{building.inhabitants_count}}</TableData>
                    <TableData>{{building.location_coordinate}}</TableData>
                    <TableData>{{building.user ? building.user.name : '...'}}</TableData>
                    <TableData>
                        <Link :href="route('buildings.show', building.id)">
                            <button class="hover:text-primary">
                                <EyeSvg/>
                            </button>
                        </Link>
                    </TableData>
                </tr>
                <tr v-show="buildings.data.length === 0">
                    <TableData class="text-center italic text-xl row-span-3" :colspan="6" >No Records...</TableData>
                </tr>
            </tbody>
        </Table>

        <Pagination :links="buildings.links"/>
        </div>
</template>
