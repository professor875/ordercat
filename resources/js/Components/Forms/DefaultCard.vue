<script setup lang="ts">
const props = defineProps({
    cardTitle: String,
})
</script>

<template>
  <div
    :class="['rounded-sm border bg-white shadow-default dark:bg-boxdark']"
  >
    <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
      <h3 class="font-medium text-black dark:text-white">{{ props.cardTitle }}</h3>
    </div>
    <div class="p-6.5 ">
        <slot/>
    </div>
  </div>
</template>
