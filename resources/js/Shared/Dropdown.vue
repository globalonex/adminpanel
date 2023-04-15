<Dropdown>
<template #trigger>
  <button class="flex items-center">
    <span class="mr-2">Menu</span>
    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
      <path
          fill-rule="evenodd"
          d="M10.707,14.707 L15.707,9.707 C16.098,9.316 16.098,8.684 15.707,8.293 C15.316,7.902 14.684,7.902 14.293,8.293 L10,12.586 L5.707,8.293 C5.316,7.902 4.684,7.902 4.293,8.293 C3.902,8.684 3.902,9.316 4.293,9.707 L9.293,14.707 C9.488,14.902 9.744,15 10,15 C10.256,15 10.512,14.902 10.707,14.707 Z"
          clip-rule="evenodd"
      ></path>
    </svg>
  </button>
</template>

<template #content>
  <div class="p-2 bg-white shadow rounded">
    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Item 1</a>
    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Item 2</a>
    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Item 3</a>
  </div>
</template>
</Dropdown>

<script>
import { Dropdown } from '@tailwindcss/ui'
export default {
  name: "Dropdown"
}
</script>

<style scoped>

</style>