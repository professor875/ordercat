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
import {isObject} from "@vueuse/core";


defineProps({
    items: Object
})

</script>
<template>
    <Head :title="trans('Item')"/>
    <BreadcrumbDefault :pageTitle="trans('Item')" />

    <Link :href="route('items.create')"><PrimaryButton class="bg-success">{{trans('Add')}}</PrimaryButton></Link>

    <div class="flex flex-col gap-10 mt-4">
        <Table class=" border border-primary">
            <thead>
            <TableHeadRow>
                <TableHead>{{trans('#SR')}}</TableHead>
                <TableHead>{{trans('Title')}}</TableHead>
                <TableHead>{{trans('Description')}}</TableHead>
                <TableHead>{{trans('Action')}}</TableHead>
            </TableHeadRow>
            </thead>
            <tbody>
            <tr v-for="(item, index) in items.data" :key="index">
                <TableData>{{index + 1}}</TableData>
                <TableData>{{item.title}}</TableData>
                <TableData>{{item.description}}</TableData>
                <TableData>
                    <Link :href="route('items.show', item.id)">
                        <button class="hover:text-primary">
                            <EyeSvg/>
                        </button>
                    </Link>
                </TableData>
            </tr>
            <tr v-show="items.data.length === 0">
                <TableData class="text-center italic text-xl row-span-3" :colspan="4" >No Records...</TableData>
            </tr>
            </tbody>
        </Table>

        <Pagination :links="items.links"/>
    </div>
</template>
