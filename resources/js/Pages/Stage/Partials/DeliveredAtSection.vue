<script setup>
import {currentDateTime, trans} from "@/utils.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import {ref} from "vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    stage: Object,
})

const open = ref(false);
const form = useForm({
    delivered_at: props.stage.delivered_at ?? currentDateTime()
})

const handleSubmit = () => {
    form.put(route('stages.assign-delivered-at', props.stage.id), {
        onSuccess: () => open.value = false,
    });
}
</script>

<template>
    <PrimaryButton type="submit" @click="open = true" class="bg-delivered">
        {{ trans('Delivered') }}
    </PrimaryButton>

        <DefaultCard v-show="open" :cardTitle="trans('Select Delivered at')"
                     class="fixed min-w-[700px] top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] z-10">
            <form @submit.prevent="handleSubmit">
                <TextInput
                    :label="trans('Delivered At')"
                    type="datetime-local"
                    :required="true"
                    v-model="form.delivered_at"
                    :error="form.errors.delivered_at"
                />

                <div class="flex justify-end mt-4.5">
                    <PrimaryButton>{{trans('Submit')}}</PrimaryButton>
                </div>
            </form>
        </DefaultCard>

        <div v-show="open" class="fixed inset-0 backdrop-blur" @click="open = false"></div>
</template>
