<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import Table from "@/Components/Tables/Table.vue";
import {trans} from "@/utils.js";
import TableHeadRow from "@/Components/Tables/TableHeadRow.vue";
import TableData from "@/Components/Tables/TableData.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import {Link} from "@inertiajs/vue3";
import EyeSvg from "@/assets/svg/light/EyeSvg.vue";

const kitchens = ref([])

onMounted(() => {
    axios.post(route('dashboard.best-kitchens')).then(response => {
        kitchens.value = response.data.kitchens;
    })
})
</script>

<template>
    <Table class="border-stroke dark:border-form-strokedark">
        <thead>
        <TableHeadRow>
            <TableHead>#SR</TableHead>
            <TableHead>{{trans('Title')}}</TableHead>
            <TableHead>{{trans('Stages')}}</TableHead>
            <TableHead>{{trans('Action')}}</TableHead>
        </TableHeadRow>
        </thead>
        <tbody>
        <tr v-for="(kitchen, index) in kitchens" :key="index">
            <TableData>{{index + 1}}</TableData>
            <TableData>{{kitchen.title}}</TableData>
            <TableData>{{kitchen.stages_count}}</TableData>
            <TableData>
                <Link :href="route('kitchens.show', kitchen.id)">
                    <button class="hover:text-primary">
                        <EyeSvg/>
                    </button>
                </Link>
            </TableData>
        </tr>
        <tr v-show="kitchens.length === 0">
            <TableData class="text-center italic text-xl row-span-3" :colspan="4" >{{ trans('No Records...') }}</TableData>
        </tr>
        </tbody>
    </Table>
</template>
