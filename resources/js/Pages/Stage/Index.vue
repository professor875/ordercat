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
import {ref} from "vue";


defineProps({
    stages: Object
})

const resolveBackgroundColor = (stage) => {
    if (!stage.cooked_at){
        return 'bg-cooked';
    }
    else if(stage.cooked_at && !stage.packaging_at){
        return 'bg-packing'
    }
    else if(stage.packaging_at && !stage.deliveredBy){
        return 'bg-delivery'
    }
    else if(stage.deliveredBy && !stage.delivered_at){
        return 'bg-delivered'
    }
    else if(stage.delivered_at && !stage.handedTo){
        return 'bg-handed'
    }
    else if(stage.handedTo && !stage.delivery_rating && !stage.kitchen_rating){
        return 'bg-rating'
    }
    else{
        return '';
    }
}
</script>
<template>
    <Head :title="trans('Stage')"/>
    <BreadcrumbDefault :pageTitle="trans('Stage')" />

    <Link :href="route('stages.create')"><PrimaryButton class="bg-success">{{trans('Add')}}</PrimaryButton></Link>

    <div class="flex flex-col gap-10 mt-4">
        <Table class=" border border-primary">
            <thead>
            <TableHeadRow>
                <TableHead>{{trans('#SR')}}</TableHead>
                <TableHead>{{trans('Description')}}</TableHead>
                <TableHead>{{trans('Ordered For')}}</TableHead>
                <TableHead>{{trans('Ordered From')}}</TableHead>
                <TableHead>{{trans('Delivery')}}</TableHead>
                <TableHead>{{trans('Created By')}}</TableHead>
                <TableHead>{{trans('Started At')}}</TableHead>
                <TableHead>{{trans('Action')}}</TableHead>
            </TableHeadRow>
            </thead>
            <tbody>
            <tr v-for="(stage, index) in stages.data" :key="index" :class="resolveBackgroundColor(stage)">
                <TableData>{{index + 1}}</TableData>
                <TableData>{{stage.description}}</TableData>
                <TableData>{{stage.orderedFor.title}}</TableData>
                <TableData>{{stage.orderedFrom.title}}</TableData>
                <TableData>{{stage.delivery_at}}</TableData>
                <TableData>{{stage.createdBy.name}}</TableData>
                <TableData>{{stage.started_at}}</TableData>

                <TableData>
                    <Link :href="route('stages.show', stage.id)">
                        <button class="hover:text-primary">
                            <EyeSvg/>
                        </button>
                    </Link>
                </TableData>
            </tr>
            <tr v-show="stages.data.length === 0">
                <TableData class="text-center italic text-xl row-span-3" :colspan="8" >No Records...</TableData>
            </tr>
            </tbody>
        </Table>

        <Pagination :links="stages.links"/>
    </div>
</template>
