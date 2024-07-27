<script setup>
import {currentDateTime, trans} from "@/utils.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import {ref} from "vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import SelectInput from "@/Components/Forms/SelectInput.vue";


const props = defineProps({
    stage: Object,
})

const open = ref(false);
const form = useForm({
    cooked_at: props.stage.cooked_at ?? currentDateTime()
})

const handleSubmit = () => {
    form.put(route('stages.assign-cooked-at', props.stage.id), {
        onSuccess: () => open.value = false,
    });
}
</script>

<template>
    <PrimaryButton type="submit" @click="open = true" class="bg-cooked">
        {{ trans('Cooked') }}
    </PrimaryButton>

        <DefaultCard v-show="open" :cardTitle="trans('Select Cooked at')"
                     class="fixed min-w-[700px] top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] z-10">
            <form @submit.prevent="handleSubmit">
                <TextInput
                    :label="trans('Cooked At')"
                    type="datetime-local"
                    :required="true"
                    v-model="form.cooked_at"
                    :error="form.errors.cooked_at"
                />

                <div class="flex justify-end mt-4.5">
                    <PrimaryButton>{{trans('Submit')}}</PrimaryButton>
                </div>
            </form>
        </DefaultCard>

        <div v-show="open" class="fixed inset-0 backdrop-blur" @click="open = false"></div>
</template>
