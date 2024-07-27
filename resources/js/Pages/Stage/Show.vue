<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import {Head, Link, router,} from "@inertiajs/vue3";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import Swal from "sweetalert2";
import {hasPermission, trans} from "@/utils.js";
import Table from "@/Components/Tables/Table.vue";
import TableData from "@/Components/Tables/TableData.vue";
import TableHeadRow from "@/Components/Tables/TableHeadRow.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import DeliveredBySection from "@/Pages/Stage/Partials/DeliveredBySection.vue";
import HandedToSection from "@/Pages/Stage/Partials/HandedToSection.vue";
import DeliveredAtSection from "@/Pages/Stage/Partials/DeliveredAtSection.vue";
import {computed} from "vue";
import StageRatingSection from "@/Pages/Stage/Partials/StageRatingSection.vue";
import PackagingAtSection from "@/Pages/Stage/Partials/PackagingAtSection.vue";
import CookedAtSection from "@/Pages/Stage/Partials/CookedAtSection.vue";
import StarRating from 'vue-star-rating';
import StageItemRating from "@/Pages/Stage/Partials/StageItemRating.vue";

const props = defineProps({
    stage: Object,
    deliveredByAble: Array,
    handedToAble: Array,
    rating: Array
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
            router.delete(route('stages.destroy', props.stage.id))
        }
    })
}

const showCookedAtSection = computed(() => !props.stage.cooked_at && hasPermission('stage.cooked'))
const showPackagingAtSection = computed(() => props.stage.cooked_at && !props.stage.packaging_at && hasPermission('stage.packaging'))
const showDeliveryBySection = computed(() => props.stage.packaging_at && !props.stage.deliveredBy && hasPermission('stage.delivery'))
const showDeliveredAtSection = computed(() => props.stage.deliveredBy && !props.stage.delivered_at && hasPermission('stage.delivery'))
const showHandedToSection = computed(() => props.stage.delivered_at && !props.stage.handedTo && hasPermission('stage.handed'))
const showRatingSection = computed(() => props.stage.handedTo && hasPermission('stage.handed'))
</script>

<template>
    <Head :title="trans('Stage')"/>

    <BreadcrumbDefault :pageTitle="trans('Stage')"/>

    <Link :href="route('stages.index')">
        <PrimaryButton>{{trans('Back')}}</PrimaryButton>
    </Link>

    <DefaultCard :cardTitle="trans('Stage Detail')" class="mt-4 border-stroke dark:border-form-strokedark">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4.5 gap-x-10 lg:gap-x-20 xl:gap-x-80">
            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Description')}}:</h4>
                <p>{{stage.description}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Ordered For')}}:</h4>
                <p>{{stage.orderedFor?.title}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Ordered From')}}:</h4>
                <p>{{stage.orderedFrom?.title}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Delivery')}}:</h4>
                <p>{{stage.delivery_at}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Started At')}}:</h4>
                <p>{{stage.started_at}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Created By')}}:</h4>
                <p>{{stage.createdBy?.name}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Delivered By')}}:</h4>
                <p>{{stage.deliveredBy?.name}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Delivered At')}}:</h4>
                <p>{{stage.delivered_at}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Handed To')}}:</h4>
                <p>{{stage.handedTo?.name}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Handed At')}}:</h4>
                <p>{{stage.handed_at}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Cooked At')}}:</h4>
                <p>{{stage.cooked_at}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Packaging At')}}:</h4>
                <p>{{stage.packaging_at}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Delivery Rating')}}:</h4>
                <p class=""> {{ stage.delivery_rating}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Kitchen Rating')}}:</h4>
                <p class=""> {{ stage.kitchen_rating}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Employees Rating')}}:</h4>
                <p class=""> {{ stage.employees_rating}}</p>
            </div>

            <div class="flex justify-between items-center">
                <h4 class="text-black dark:text-white">{{trans('Instruments Rating')}}:</h4>
                <p class=""> {{ stage.instruments_rating}}</p>
            </div>

            <div class="col-span-2 flex justify-start items-center gap-4 my-4">
                <h4 class="text-black dark:text-white">{{trans('Note')}}:</h4>
                <p class=""> {{ stage.note}}</p>
            </div>

        </div>

        <Table class="mt-4.5 border-stroke dark:border-form-strokedark">
            <thead>
            <TableHeadRow>
                <TableHead>{{trans('#SR')}}</TableHead>
                <TableHead>{{trans('Item')}}</TableHead>
                <TableHead>{{trans('Quantity')}}</TableHead>
                <TableHead>{{trans('Rating')}}</TableHead>
            </TableHeadRow>
            </thead>
            <tbody>
            <tr v-for="(item, index) in stage.items" :key="index">
                <TableData>{{index + 1}}</TableData>
                <TableData>{{item.title}}</TableData>
                <TableData>{{item?.quantity}}</TableData>
                <TableData>
                    <StageItemRating :stage="stage" :item="item" :rating-list="rating"/>
                </TableData>
            </tr>
            </tbody>
        </Table>

        <div class="mt-4.5 flex justify-between items-center gap-x-4.5">
            <div class="flex items-center gap-x-4.5">
                <!--

                    if null delivered_by show Delivery-BUTTON @on-click choose from contacts who to deliver
                    if null delivered_at show Delivered-Button @on-click choose from buildings to which its been delivered (default ordered_for) and *delivere_at timestamp
                    if null handed_at show Handed-Button @on-click choose from contacts who handed_to and *timestamp handed_at
                    if null delivery_evaluation show Evaluation-Button @on-click choose 1-9 delivery_evaluation, kitchen_evaluation and stage-items.item_evaluation

                    the above is the sequence of the button enable/disable so if the pervious is diabled means below is also disabled but shown
                -->

                <CookedAtSection v-if="showCookedAtSection" :stage="stage"/>
                <PackagingAtSection v-else-if="showPackagingAtSection" :stage="stage"/>
                <DeliveredBySection v-else-if="showDeliveryBySection" :deliveredByAble="deliveredByAble" :stage="stage"/>
                <DeliveredAtSection v-else-if="showDeliveredAtSection" :stage="stage" />
                <HandedToSection v-else-if="showHandedToSection" :handedToAble="handedToAble" :stage="stage"/>
                <StageRatingSection  v-else-if="showRatingSection" :stage="stage" :rating-list="rating" />
            </div>

            <div class="flex items-center gap-x-4.5">
                <Link  v-if="hasPermission('stage.edit')" :href="route('stages.edit', stage.id)" class="bg-warning py-3 px-6 rounded-md hover:bg-opacity-75 text-white mx-2">
                        {{trans('Edit')}}
                </Link>

                <PrimaryButton  v-if="hasPermission('stage.delete')" class="bg-red" @click="destroy">
                    {{trans('Delete')}}
                </PrimaryButton>
            </div>
        </div>
    </DefaultCard>
</template>
