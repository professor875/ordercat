<template>
  <div
    :class="['rounded-sm border bg-white px-5 pt-6 pb-2.5 shadow-default dark:bg-boxdark sm:px-7.5 xl:pb-1']"
  >
    <div class="max-w-full overflow-x-auto">
      <table class="w-full table-auto">
        <slot/>
      </table>
    </div>
  </div>
</template>
