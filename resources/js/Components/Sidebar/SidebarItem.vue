<script setup>
import {Link} from "@inertiajs/vue3";
import SidebarDropdown from "@/Components/Sidebar/SidebarDropdown.vue";
import sidebar from "@/stores/sidebar.js";
import {trans} from "../../utils.js";

const props = defineProps({
    item: Object,
})

const handleItemClick = () => {
    if (sidebar.activeLabel === props.item.label) {
        sidebar.setActiveLabel('');
    } else {
        sidebar.setActiveLabel(props.item.label);
    }
}
</script>

<template>
  <li @click="handleItemClick">
    <Link v-if="item.permissionCheck"
      :href="item.route"
      class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
      :class="{
        'bg-graydark dark:bg-meta-4': item.label === sidebar.activeLabel
      }"
    >
      <Component :is="item.icon"/>

      {{ trans(item.label) }}

      <svg
        v-if="item.children"
        class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
        :class="{ 'rotate-180': item.label === sidebar.activeLabel }"
        width="20"
        height="20"
        viewBox="0 0 20 20"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
          fill=""
        />
      </svg>
    </Link>

    <!-- Dropdown Menu Start -->
    <div class="translate transform overflow-hidden" v-show="item.label === sidebar.activeLabel">
      <SidebarDropdown
        v-if="item.children"
        :items="item.children"
        :page="item.label"
      />
      <!-- Dropdown Menu End -->
    </div>
  </li>
</template>
