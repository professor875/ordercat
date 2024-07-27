<script setup>
import {trans} from "@/utils.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import SelectInput from "@/Components/Forms/SelectInput.vue";

const props = defineProps({
    stage: Object,
    ratingList: Array
})

const open = ref(false);

const updateRatingForm = useForm({
    kitchen_rating: props.stage.kitchen_rating,
    delivery_rating: props.stage.delivery_rating,
    employees_rating: props.stage.employees_rating,
    instruments_rating: props.stage.instruments_rating,
})

const updateRating = () => {
    console.log('selecting')
    updateRatingForm.put(route('stages.update-rating', props.stage.id), {
        onSuccess: () => open.value = false
    });
}
</script>

<template>
    <PrimaryButton type="submit" @click="open = true" class="bg-rating">
        {{ trans('Rating') }}
    </PrimaryButton>

    <DefaultCard v-show="open" :cardTitle="trans('Give Rating')"
                 class="fixed min-w-[700px] top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] z-10 border-stroke dark:border-form-strokedark">

        <div class="flex justify-between items-center mb-6">
            <SelectInput class="w-full"
                         :label="trans('Delivery Rating')"
                         :required="true"
                         :error="updateRatingForm.errors.delivery_rating"
                         v-model="updateRatingForm.delivery_rating"
            >
                <option value="" selected disabled>{{ trans('Rate Delivery') }}</option>
                <option
                    v-for="(rating, index) in ratingList"
                    :key="index"
                    :value="rating"
                >{{ trans(rating) }}
                </option>
            </SelectInput>
        </div>

        <div class="flex justify-between items-center">
            <SelectInput class="w-full"
                         :label="trans('Kitchen Rating')"
                         :required="true"
                         :error="updateRatingForm.errors.kitchen_rating"
                         v-model="updateRatingForm.kitchen_rating"
            >
                <option value="" selected disabled>{{ trans('Rate Kitchen') }}</option>
                <option
                    v-for="(rating, index) in ratingList"
                    :key="index"
                    :value="rating"
                >{{ trans(rating) }}
                </option>
            </SelectInput>
        </div>
        <div class="flex justify-between items-center my-6">
            <SelectInput class="w-full"
                         :label="trans('Employees Rating')"
                         :required="true"
                         :error="updateRatingForm.errors.employees_rating"
                         v-model="updateRatingForm.employees_rating"
            >
                <option value="" selected disabled>{{ trans('Employees Rating') }}</option>
                <option
                    v-for="(rating, index) in ratingList"
                    :key="index"
                    :value="rating"
                >{{ trans(rating) }}
                </option>
            </SelectInput>
        </div>

        <div class="flex justify-between items-center">
            <SelectInput class="w-full"
                         :label="trans('Instruments Rating')"
                         :required="true"
                         :error="updateRatingForm.errors.instruments_rating"
                         v-model="updateRatingForm.instruments_rating"
            >
                <option value="" selected disabled>{{ trans('Instruments Rating') }}</option>
                <option
                    v-for="(rating, index) in ratingList"
                    :key="index"
                    :value="rating"
                >{{ trans(rating) }}
                </option>
            </SelectInput>
        </div>

        <PrimaryButton :disabled="updateRatingForm.processing" type="submit" @click="updateRating()" class="my-4 float-end">
            {{ updateRatingForm.processing ? trans('Please wait...') : trans('Update') }}
        </PrimaryButton>

    </DefaultCard>

    <div v-show="open" class="fixed inset-0 backdrop-blur" @click="open = false"></div>
</template>
