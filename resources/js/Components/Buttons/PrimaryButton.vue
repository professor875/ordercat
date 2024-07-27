<script setup>
defineProps({
    disabled: {
        type: Boolean,
        default: false,
    }
})
</script>

<template>
  <button
    class="inline-flex items-center justify-center gap-2.5 py-3 px-6 text-center font-medium bg-primary text-white rounded-md"
    :class="{
      'bg-opacity-50': disabled,
      'hover:bg-opacity-90': !disabled,
  }"
    :disabled="disabled"
  >
    <slot/>
  </button>
</template>
