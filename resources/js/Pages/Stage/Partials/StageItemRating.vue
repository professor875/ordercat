<script setup>
import {useForm} from "@inertiajs/vue3";
import {trans} from "@/utils.js";
import SelectInput from "@/Components/Forms/SelectInput.vue";

const props = defineProps({
    stage: Object,
    item: Object,
    ratingList:Array
})

const form = useForm({
    rating: props.item.rating,
})

const updateRating = () => {
    form.put(route('stage-items.update-rating', [props.stage.id, props.item.id]));
}
</script>

<template>
    <SelectInput class=" m-0 py-0 h-3 -mt-9"
                 @change="updateRating()"
                 :required="true"
                 :error="form.errors.rating"
                 v-model="form.rating"
    >
        <option value="" selected disabled>{{ trans('Rate Item') }}</option>
        <option
            v-for="(rating, index) in ratingList"
            :key="index"
            :value="rating"
        >{{ trans(rating) }}
        </option>
    </SelectInput>

<!--    <StarRating-->
<!--        v-model:rating="form.rating"-->
<!--        :starSize="20"-->
<!--        :showRating="false"-->
<!--        :maxRating="5"-->
<!--        :clearable="true"-->
<!--        :animate="true"-->
<!--        @update:rating="updateRating"-->
<!--    />-->
</template>
