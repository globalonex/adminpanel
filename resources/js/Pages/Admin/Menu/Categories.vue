<template>
    <div class="p-3 flex items-center justify-between">
        <button type="button" data-drawer-target="drawer-right" data-drawer-show="drawer-right"
                data-drawer-placement="right" aria-controls="drawer-right"
                :class="styles.main.button_primary">
            Добавить
        </button>
        <div class="actions flex items-center">
            <div class="actions flex md:flex-row flex-col items-center">
                <input-search-component v-model="searchQuery" @search="handleSearch"/>
            </div>
        </div>
    </div>
    <hr class="h-px mt-2.5 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs bg_products_table text-gray-700 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-sm">
                    Название
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in filteredProducts" :key="product.id" class="bg-white dark:bg-gray-800">
                <!-- Отображение данных продуктов в таблице -->
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ product.name }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <DrawerComponent id="drawer-right">
        <!--        {{ drawer.selectedFileName ? `Выбранный файл: ${drawer.selectedFileName}` : 'Выберите файл' }}-->
        <div class="block sm:grid md:grid grid-cols-3 gap-2 mb-4">
            <div class="col-span-2 select-none mr-0 md:mr-7">
                <div>
                    <label for="small-input" :class="styles.drawer.label">Название позиции</label>
                    <input type="text" v-model="drawer.namePosition" id="small-input" :class="styles.drawer.input">
                </div>
            </div>
        </div>
        <div class="group mx-0">
            <button type="button" :class="styles.main.button_primary" class="mr-3.5">Сохранить</button>
            <button type="button" :class="styles.main.button_light">Отменить</button>

            <div class="deleteCat pt-3">
                <div class="flex flex-row">
                    <div class="icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="16" fill="#F56C6C"/>
                            <path d="M11.1875 12.5H10.3125C10.1848 12.5 10.0799 12.459 9.99794 12.3771C9.91598 12.2951 9.875 12.1903 9.875 12.0625C9.875 11.9348 9.91598 11.8299 9.99794 11.7479C10.0799 11.666 10.1848 11.625 10.3125 11.625H13.8125V10.3125C13.8125 10.1848 13.8535 10.0799 13.9354 9.99794C14.0174 9.91598 14.1223 9.875 14.25 9.875H17.75C17.8778 9.875 17.9826 9.91598 18.0646 9.99794C18.1465 10.0799 18.1875 10.1848 18.1875 10.3125V11.625H21.6875C21.8153 11.625 21.9201 11.666 22.0021 11.7479C22.084 11.8299 22.125 11.9348 22.125 12.0625C22.125 12.1903 22.084 12.2951 22.0021 12.3771C21.9201 12.459 21.8153 12.5 21.6875 12.5H20.8125V21.6875C20.8125 21.8153 20.7715 21.9201 20.6896 22.0021C20.6076 22.084 20.5028 22.125 20.375 22.125H11.625C11.4973 22.125 11.3924 22.084 11.3104 22.0021C11.2285 21.9201 11.1875 21.8153 11.1875 21.6875V12.5ZM17.3125 11.625V10.75H14.6875V11.625H17.3125ZM12.0625 21.25H19.9375V12.5H12.0625V21.25ZM14.6875 19.5C14.5598 19.5 14.4549 19.459 14.3729 19.3771C14.291 19.2951 14.25 19.1903 14.25 19.0625V14.6875C14.25 14.5598 14.291 14.4549 14.3729 14.3729C14.4549 14.291 14.5598 14.25 14.6875 14.25C14.8153 14.25 14.9201 14.291 15.0021 14.3729C15.084 14.4549 15.125 14.5598 15.125 14.6875V19.0625C15.125 19.1903 15.084 19.2951 15.0021 19.3771C14.9201 19.459 14.8153 19.5 14.6875 19.5ZM17.3125 19.5C17.1848 19.5 17.0799 19.459 16.9979 19.3771C16.916 19.2951 16.875 19.1903 16.875 19.0625V14.6875C16.875 14.5598 16.916 14.4549 16.9979 14.3729C17.0799 14.291 17.1848 14.25 17.3125 14.25C17.4403 14.25 17.5451 14.291 17.6271 14.3729C17.709 14.4549 17.75 14.5598 17.75 14.6875V19.0625C17.75 19.1903 17.709 19.2951 17.6271 19.3771C17.5451 19.459 17.4403 19.5 17.3125 19.5Z" fill="white"/>
                        </svg>
                    </div>
                    <span class="px-2 self-center text-sm text-[#303133]">Удалить позицию</span>
                </div>
            </div>
        </div>
    </DrawerComponent>
</template>

<script>
import InputSearchComponent from "../../../Shared/Components/InputSearchComponent.vue";
import DrawerComponent from "../../../Shared/Components/DrawerComponent.vue";
import CategoryComponent from "../../../Shared/Components/CategoryComponent.vue";
import styles from "./../../../components/config/styles";

export default {
    name: "Dishes",
    components: {DrawerComponent, InputSearchComponent, CategoryComponent},
    data() {
        return {
            symbol: " ₽",
            categories: [
                {
                    id: 1,
                    name: "Пицца"
                },
                {
                    id: 2,
                    name: "Роллы"
                },
                {
                    id: 3,
                    name: "Китайская кухня"
                },
                {
                    id: 4,
                    name: "Категория 3"
                },

            ],
            products: [
                {
                    "name": "Российская",
                    "category_id": 2,
                    "category": "Роллы",
                    "price": 1000,
                    "quantity": 10,
                    "image": "product1.jpg"
                },
                {
                    "name": "Американская",
                    "category_id": 2,
                    "price": 2000,
                    "category": "Роллы",
                    "quantity": 5,
                    "image": "product2.jpg"
                },
                {
                    "name": "Продукт 3",
                    "category_id": 1,
                    "price": 4500,
                    "category": "Пицца",
                    "quantity": 8,
                    "image": "product3.jpg"
                },
                {
                    "name": "Продукт 4",
                    "category_id": 3,
                    "price": 8500,
                    "category": "Китайская кухня",
                    "quantity": 8,
                    "image": "product3.jpg"
                }
            ], // Данные продуктов
            searchQuery: '', // Запрос для поиска
            filteredProducts: [], // Массив отфильтрованных продуктов
            selectedCategory: "", // Выбранная категория

            drawer: {
                namePosition: null,
                price: null,
                quantity: null,
                categoryProduct: {},
                selectedFile: null,
                selectedFileName: null,

            }
        };
    },
    mounted() {
        // Загрузка данных о продуктах и категориях при монтировании компонента
        this.loadProducts();
        this.loadCategories();
    },
    computed: {
        styles() {
            return styles
        },
        filteredProducts() {
            let filteredProducts = this.products;
            if (this.searchQuery) {
                filteredProducts = filteredProducts.filter(product => product.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
            }
            if (this.selectedCategory) {
                filteredProducts = filteredProducts.filter(product => product.category_id == this.selectedCategory);
            }
            return filteredProducts;
        },

    },
    methods: {
        productChooser() {
            const input = document.createElement('input');
            input.type = 'file';
            input.onchange = (event) => {
                const file = event.target.files[0];
                this.drawer.selectedFile = file;
                this.drawer.selectedFileName = file.name;
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    this.$refs.previewImage.src = reader.result;
                });

                reader.readAsDataURL(file);
            };
            input.click();
        },
        handleSearch(searchQuery) {
            this.searchQuery = searchQuery;
        },
        loadProducts() {
            // Загрузка данных о продуктах с сервера
            // и сохранение их в this.products
        },
        loadCategories() {
            // Загрузка данных о категориях с сервера
            // и сохранение их в this.categories
        },
        handleProductCategory(categoryId) {
            let cat = this.categories.find(category => category.id === categoryId);
            return this.drawer.categoryProduct = cat;
        },
        getCategoryNameById(categoryId) {
            let category = this.categories.find(category => category.id === categoryId);
            return category ? category.name : '';
        },
    },

}
</script>

<style scoped>
.bg_products_table {
    background: #F5F7FA;
    color: #606266;

}

.bg_products_table tr th {
    font-weight: 600;

}
</style>