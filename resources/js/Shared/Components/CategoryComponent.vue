<template>
    <select v-model="selectedCategory"
            id="small"
            @change="handleCategoryChange"
            :class="drawer_class !== null ? drawer_class : this.baseClass"
            >
        <option value="" selected>Категория</option>
        <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
    </select>
</template>

<script>
export default {
    name: "CategoryComponent",
    props: {
        categories: Array,
        drawer_class: {
            type: String,
            default: null
        },

    },
    data() {
        return {
            selectedCategory: "",
            baseClass: "block w-full sm:w-52 sm:ml-9 py-1.5 px-3 pl-3.5 mt-2 sm:mt-0 text-sm text-gray-400 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        };

    },
    methods: {
        handleCategoryChange() {
            this.$emit("category-change", this.selectedCategory);
        },
    },
};
</script>