<script setup>
import {Head} from '@inertiajs/vue3';
import {hasPermission, trans} from "@/utils.js";
import {ref} from "vue";
import CountCard from "@/Pages/Dashboard/Partials/CountCard.vue";
import BuildingSvg from "@/assets/svg/BuildingSvg.vue";
import KitchenSvg from "@/assets/svg/KitchenSvg.vue";
import ItemSvg from "@/assets/svg/ItemSvg.vue";
import StageSvg from "@/assets/svg/StageSvg.vue";
import StagesLineChart from "@/Pages/Dashboard/Partials/StagesLineChart.vue";
import BestBuildingsTable from "@/Pages/Dashboard/Partials/BestBuildingsTable.vue";
import BestKitchensTable from "@/Pages/Dashboard/Partials/BestKitchensTable.vue";
import BestItemsTable from "@/Pages/Dashboard/Partials/BestItemsTable.vue";
import StagesPaiChart from "@/Pages/Dashboard/Partials/StagesPaiChart.vue";

defineProps({
    counts: Object
})

</script>

<template>
    <Head :title="trans('Dashboard')" />

    <div v-if="hasPermission('dashboard.count')" class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
        <CountCard
        :label="trans('Total Buildings')" :count="counts.building"
        :icon="BuildingSvg"
        />

        <CountCard
            :label="trans('Total Kitchens')"
            :count="counts.kitchen"
            :icon="KitchenSvg"
        />

        <CountCard
            :label="trans('Total Items')"
            :count="counts.item"
            :icon="ItemSvg"
        />

        <CountCard
            :label="trans('Total Stages')"
            :count="counts.stage"
            :icon="StageSvg"
        />
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
        <StagesLineChart/>

        <StagesPaiChart/>

        <div class="col-span-12 xl:col-span-6">
            <h3 class="text-black dark:text-white">{{ trans('Best Buildings') }}</h3>
            <BestBuildingsTable/>
        </div>

        <div class="col-span-12 xl:col-span-6">
            <h3 class="text-black dark:text-white">{{ trans('Best Kitchens') }}</h3>
            <BestKitchensTable/>
        </div>

        <div class="col-span-12 xl:col-span-6">
            <h3 class="text-black dark:text-white">{{ trans('Best Items') }}</h3>
            <BestItemsTable/>
        </div>
    </div>
</template>
