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
    kitchens: Object
})

</script>

<template>
    <Head :title="trans('Kitchen')"/>
    <BreadcrumbDefault :pageTitle="trans('Kitchen')" />

    <Link :href="route('kitchens.create')"><PrimaryButton class="bg-success">{{ trans('Add') }}</PrimaryButton></Link>

    <div class="flex flex-col gap-10 mt-4">
        <Table class=" border border-primary">
            <thead>
            <TableHeadRow>
                <TableHead>#SR</TableHead>
                <TableHead>{{trans('Title')}}</TableHead>
                <TableHead>{{trans('Commercial Registration')}}</TableHead>
                <TableHead>{{trans('Location Coordinate')}}</TableHead>
                <TableHead>{{trans('User')}}</TableHead>
                <TableHead>{{trans('Action')}}</TableHead>
            </TableHeadRow>
            </thead>
            <tbody>
                <tr v-for="(kitchen, index) in kitchens.data" :key="index">
                    <TableData>{{index + 1}}</TableData>
                    <TableData>{{kitchen.title}}</TableData>
                    <TableData>{{kitchen.commercial_registration}}</TableData>
                    <TableData>{{kitchen.location_coordinate}}</TableData>
                    <TableData>{{kitchen.user.name}}</TableData>
                    <TableData>
                        <Link :href="route('kitchens.show', kitchen.id)">
                            <button class="hover:text-primary">
                                <EyeSvg/>
                            </button>
                        </Link>
                    </TableData>
                </tr>
                <tr v-show="kitchens.data.length === 0">
                    <TableData class="text-center italic text-xl row-span-3" :colspan="5" >No Records...</TableData>
                </tr>
            </tbody>
        </Table>

        <Pagination :links="kitchens.links"/>
        </div>
</template>
