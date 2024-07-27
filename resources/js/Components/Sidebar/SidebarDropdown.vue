<script setup>
import {onMounted, ref} from 'vue'
import {Link, router} from "@inertiajs/vue3";

const props = defineProps({
    items: Array
})

const activeLabel = ref('')

const checkActiveLabel = () => {
    activeLabel.value = props.items.find(item => route().current(item.nameToMatch))?.label ?? '';
}

onMounted(() => {
    checkActiveLabel()

    router.on('finish', () => {
        checkActiveLabel()
    })
})
</script>

<template>
  <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
    <template v-for="(childItem, index) in items" :key="index">
      <li>
        <Link
          :href="childItem.route"
          class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
          :class="{
            '!text-white': childItem.label === activeLabel
          }"
        >
          {{ childItem.label }}
        </Link>
      </li>
    </template>
  </ul>
</template>
