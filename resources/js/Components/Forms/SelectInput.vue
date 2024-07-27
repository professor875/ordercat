<script setup>
import {onMounted, ref} from 'vue'
import KeyBoardDownArrowSvg from "@/assets/svg/light/KeyBoardDownArrowSvg.vue";

defineProps({
    label: String,
    required: {
        type: Boolean,
        default: false
    },
    error: {
        type: String,
        required: false
    }
})

const isOptionSelected = ref(false)

const model = defineModel({
    required: false,
});

const input = ref(null);

const changeTextColor = () => {
    isOptionSelected.value = true
}

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
  <div>
    <label class="mb-2.5 block text-black dark:text-white">{{label}}</label>

    <div class="relative z-20 bg-transparent dark:bg-form-input">
      <select
        v-model="model"
        ref="input"
        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
        :class="{ 'text-black dark:text-white': isOptionSelected }"
        @change="changeTextColor"
      >
        <slot/>
      </select>

        <p class="text-red" v-if="error">{{error}}</p>

      <span class="absolute top-1/2 ltr:right-4 rtl:left-4 z-30 -translate-y-1/2">
        <KeyBoardDownArrowSvg/>
      </span>
    </div>
  </div>
</template>
