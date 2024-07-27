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
    handedToAble: Array,
})

const open = ref(false);
const form = useForm({
    handed_to_id: props.stage.handedTo?.id ?? ''
})

const handleSubmit = () => {
    form.put(route('stages.assign-handed-to', props.stage.id), {
        onSuccess: () => open.value = false,
    });
}
</script>

<template>
    <PrimaryButton type="submit" @click="open = true" class="bg-handed">
        {{ trans('Handed To') }}
    </PrimaryButton>

        <DefaultCard v-show="open" :cardTitle="trans('Select Handed To')"
                     class="fixed min-w-[700px] top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] z-10">
            <form @submit.prevent="handleSubmit">
                <SelectInput
                    :label="trans('Select Handed To')"
                    v-model="form.handed_to_id"
                    :error="form.errors.handed_to_id"
                >
                    <option value="">{{trans('Select handed to')}}</option>

                    <option
                        v-for="(handedTo, index) in handedToAble"
                        :key="index"
                        :value="handedTo.id"
                    >
                        {{handedTo.name}}
                    </option>
                </SelectInput>

                <div class="flex justify-end mt-4.5">
                    <PrimaryButton>{{trans('Submit')}}</PrimaryButton>
                </div>
            </form>
        </DefaultCard>

        <div v-show="open" class="fixed inset-0 backdrop-blur" @click="open = false"></div>
</template>
