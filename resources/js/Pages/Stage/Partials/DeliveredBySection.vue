<script setup>
import {trans} from "@/utils.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import {ref} from "vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import SelectInput from "@/Components/Forms/SelectInput.vue";

const props = defineProps({
    stage: Object,
    deliveredByAble: Array,
})

const open = ref(false);
const form = useForm({
    delivered_by_id: props.stage.deliveredBy?.id ?? ''
})

const handleSubmit = () => {
    form.put(route('stages.assign-delivered-by', props.stage.id), {
        onSuccess: () => open.value = false,
    });
}
</script>

<template>
    <PrimaryButton type="submit" @click="open = true" class="bg-delivery">
        {{ trans('Delivery') }}
    </PrimaryButton>

        <DefaultCard v-show="open" :cardTitle="trans('Select Delivered By')"
                     class="fixed min-w-[700px] top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] z-10">
            <form @submit.prevent="handleSubmit">
                <SelectInput
                    :label="trans('Select Delivered By')"
                    v-model="form.delivered_by_id"
                    :error="form.errors.delivered_by_id"
                >
                    <option value="">{{trans('Select delivered By')}}</option>

                    <option
                        v-for="(deliveredBy, index) in deliveredByAble"
                        :key="index"
                        :value="deliveredBy.id"
                    >
                        {{deliveredBy.name}}
                    </option>
                </SelectInput>

                <div class="flex justify-end mt-4.5">
                    <PrimaryButton>{{trans('Submit')}}</PrimaryButton>
                </div>
            </form>
        </DefaultCard>

        <div v-show="open" class="fixed inset-0 backdrop-blur" @click="open = false"></div>
</template>
