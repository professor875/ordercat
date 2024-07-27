<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { onClickOutside } from '@vueuse/core'
import {createLogger} from "vite";
import KeyBoardDownArrowSvg from "@/assets/svg/light/KeyBoardDownArrowSvg.vue";

const emit = defineEmits(['update:modelValue']);

const props = defineProps({
    label: String,
    placeholder: String,
    customLabel: {
        type : Function,
        required: false,
    },
    modelValue: Array,
    options: Array,
    error:{
        type: String,
        required: false
    },
})

const target = ref(null)
const show = ref(false)
const selectedOptions = ref([]);

const open = () => {
  show.value = true
}

const isOpen = () => {
  return show.value === true
}

onClickOutside(target, () => {
  show.value = false
})

onMounted(() => {
    selectedOptions.value = props.modelValue
})

const updateModalValue = () => {
    emit('update:modelValue', selectedOptions);
}

const select = (option) => {
  const index = selectedOptions.value.findIndex(item => item === option);
    if (index !== -1) {
        remove(index)
    } else {
        selectedOptions.value.push(option)
    }
    updateModalValue();
}

const remove = (index) => {
    selectedOptions.value.splice(index, 1);
    updateModalValue()
}

const isOptionSelected = (option) => {
    return selectedOptions.value.findIndex(item => item === option) !== -1;
}
</script>

<template>
  <div class="relative z-50">
    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
      {{label}}
    </label>
    <div>

      <div class="flex flex-col items-center">
        <div class="relative z-20 inline-block w-full">
          <div class="relative flex flex-col items-center">
            <div @click="open" class="w-full">
              <div
                :class="{
                  'mb-2 flex rounded border py-2 pl-3 pr-3 outline-none transition focus:border-primary active:border-primary dark:bg-form-input' : true,
                  'border-red' : error,
                  'mb-2 flex rounded border border-stroke py-2 pl-3 pr-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input' : !error
                }"
              >
                <div class="flex flex-auto flex-wrap gap-3">
                  <template v-for="(option, index) in selectedOptions" :key="index">
                    <div
                      class="my-1.5 flex items-center justify-center rounded border-[.5px] border-stroke bg-gray px-2.5 py-1.5 text-sm font-medium dark:border-strokedark dark:bg-white/30"
                    >
                      <div class="max-w-full flex-initial">{{ customLabel ? customLabel(option) : option }}</div>
                      <div class="flex flex-auto flex-row-reverse">
                        <div @click="remove(index)" class="cursor-pointer pl-2 hover:text-danger">
                          <svg
                            class="fill-current"
                            role="button"
                            width="12"
                            height="12"
                            viewBox="0 0 12 12"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M9.35355 3.35355C9.54882 3.15829 9.54882 2.84171 9.35355 2.64645C9.15829 2.45118 8.84171 2.45118 8.64645 2.64645L6 5.29289L3.35355 2.64645C3.15829 2.45118 2.84171 2.45118 2.64645 2.64645C2.45118 2.84171 2.45118 3.15829 2.64645 3.35355L5.29289 6L2.64645 8.64645C2.45118 8.84171 2.45118 9.15829 2.64645 9.35355C2.84171 9.54882 3.15829 9.54882 3.35355 9.35355L6 6.70711L8.64645 9.35355C8.84171 9.54882 9.15829 9.54882 9.35355 9.35355C9.54882 9.15829 9.54882 8.84171 9.35355 8.64645L6.70711 6L9.35355 3.35355Z"
                              fill="currentColor"
                            ></path>
                          </svg>
                        </div>
                      </div>
                    </div>
                  </template>

                  <div v-show="selectedOptions.length === 0" class="flex-1">
                    <input
                      :placeholder="placeholder" readonly
                      class="h-full w-full appearance-none bg-transparent p-1 px-2 outline-none"
                    />
                  </div>
                </div>
                <div class="flex w-8 items-center py-1 pl-1 pr-1">
                  <button
                    @click="open"
                    type="button"
                    class="h-6 w-6 cursor-pointer outline-none focus:outline-none"
                    :class="{'rotate-180': isOpen()}"
                  >
                    <KeyBoardDownArrowSvg />
                  </button>
                </div>
              </div>
            </div>
            <div class="w-full px-4">
              <div
                v-show="isOpen()"
                ref="target"
                class="max-h-select absolute left-0 top-full z-40 w-full overflow-y-auto rounded bg-white shadow dark:bg-form-input"
              >
                <div class="flex w-full flex-col">
                  <div v-for="(option, index) in options" :key="index">
                    <div
                      @click="select(option)"
                      class="w-full cursor-pointer rounded-t border-b border-stroke hover:bg-primary/5 dark:border-form-strokedark"
                    >
                      <div
                        :class="{
                          'relative flex w-full items-center border-l-2 border-transparent p-2 pl-2': true,
                          'border-primary': isOptionSelected(option)
                        }"
                      >
                        <div class="flex w-full items-center">
                          <div class="mx-2 leading-6">{{ customLabel ? customLabel(option) : option }}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <p class="text-red" v-show="error">{{error}}</p>
  </div>

</template>
