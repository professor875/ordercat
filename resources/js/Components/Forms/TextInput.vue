<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    label: String,
    type: String,
    placeholder: String,
    required: {
        type: Boolean,
        default: false,
    },
    min: {
        type: String,
        required: false
    },
    error: {
        type: String,
        required: false
    },
    disable: {
        type: Boolean,
        default: false
    },
    readonly: {
        type: Boolean,
        default: false
    }
})

const model = defineModel({
    required: false,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <div class="w-full">
    <label class="mb-2.5 block text-black dark:text-white">{{ props.label }}</label>
    <div class="relative">
      <input
        :type="props.type"
        :placeholder="props.placeholder"
        :min="min"
        :required="required"
        class="w-full rounded border-[1.5px] text-black bg-transparent py-3 px-5 font-normal outline-none transition disabled:cursor-default disabled:bg-whiter dark:text-white dark:bg-form-input"
        :class="{
            'border-red': error,
            'border-stroke dark:border-form-strokedark focus:border-primary active:border-primary dark:focus:border-primary': !error
        }"
        :disable="disable"
        :readonly="readonly"
        v-model="model"
        ref="input"
      />

        <p class="text-red" v-if="error">{{error}}</p>

      <span class="absolute right-4 top-4">
        <slot/>
      </span>
    </div>
  </div>
</template>
