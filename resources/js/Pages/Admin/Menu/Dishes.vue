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

                <CategoryComponent :categories="categories" v-model="selectedCategory"
                                   @category-change="getCategoryNameById"/>
            </div>
        </div>
    </div>
    <hr class="h-px mt-2.5 mb-4 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs bg_products_table text-gray-700 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-sm">
                    Наименование
                </th>
                <th scope="col" class="px-6 py-3 text-sm">
                    Категория
                </th>
                <th scope="col" class="px-6 py-3 text-sm">
                    Цена
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in filteredProducts" :key="product.id" class="bg-white dark:bg-gray-800">
                <!-- Отображение данных продуктов в таблице -->
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ product.name }}
                </td>
                <td class="px-6 py-4">{{ getCategoryNameById(product.categories_id) }}</td>
                <td class="px-6 py-4">{{ product.price + symbol }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <DrawerComponent id="drawer-right">
        <!--        {{ drawer.selectedFileName ? `Выбранный файл: ${drawer.selectedFileName}` : 'Выберите файл' }}-->
        <form @submit.prevent="submitCreateForm">
            <div class="block sm:grid md:grid grid-cols-3 gap-2 mb-11">
                <div class="rounded-md mt-8 sm:mt-0 md:mt-0 border border-gray-200 border-dashed w-auto md:w-[148px] h-[260px] md:h-[148px] relative cursor-pointer md:place-self-center"
                     @click="productChooser">
                    <p v-if="errors.drawer.selectedFile" class="mt-2 text-sm text-red-600 dark:text-red-500 px-2 md:px-0 md:absolute md:-bottom-1/3">
                        {{ messages.createDrawer.photo }}</p>
                    <div class="drawer-photo-chooser">
                        <div v-if="drawer.selectedFile">
                            <img ref="previewImage"
                                 class="w-full h-full object-cover absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded"/>
                        </div>
                        <div v-else>
                            <svg width="28" height="28"
                                 class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                 viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M14 2.625C13.5168 2.625 13.125 3.01675 13.125 3.5V13.125H3.5C3.01675 13.125 2.625 13.5168 2.625 14C2.625 14.4832 3.01675 14.875 3.5 14.875H13.125V24.5C13.125 24.9832 13.5168 25.375 14 25.375C14.4832 25.375 14.875 24.9832 14.875 24.5V14.875H24.5C24.9832 14.875 25.375 14.4832 25.375 14C25.375 13.5168 24.9832 13.125 24.5 13.125H14.875V3.5C14.875 3.01675 14.4832 2.625 14 2.625Z"
                                      fill="#909399"/>
                            </svg>
                        </div>
                    </div>

                </div>
                <div class="col-span-2 select-none mr-0 md:mr-7">
                    <div>
                        <label for="small-input" :class="styles.drawer.label">Название позиции</label>
                        <!--                        bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500-->
                        <input type="text" v-model="drawer.namePosition" id="small-input"
                               :class="errors.drawer.namePosition ? this.errorCheckInput  : styles.drawer.input">
                        <p v-if="errors.drawer.namePosition" class="mt-2 text-sm text-red-600 dark:text-red-500">
                            {{ messages.createDrawer.namePosition }}</p>
                    </div>
                    <div class="grid gap-5 mt-3 mb-3 md:grid-cols-2">
                        <div>
                            <label for="small-input" :class="styles.drawer.label">Цена</label>
                            <div class="relative">
                                <input type="number" v-model="drawer.price" id="small-input"
                                       :class="errors.drawer.price ? this.errorCheckInput  : styles.drawer.input ">
                                <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-[#A8ABB2]">
                                    ₽
                                </div>
                            </div>
                            <p v-if="errors.drawer.price" class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ messages.createDrawer.price }}</p>
                        </div>
                        <div>
                            <label for="small-input" :class="styles.drawer.label">Количество</label>
                            <div class="relative">
                                <input type="number" v-model="drawer.quantity" id="small-input"
                                       :class="errors.drawer.quantity ? this.errorCheckInput  : styles.drawer.input">
                                <div class="absolute inset-y-0 right-0 px-2.5 flex items-center text-[#000000] bg-gray-200 rounded text-sm">
                                    шт.
                                </div>
                            </div>
                            <p v-if="errors.drawer.quantity" class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ messages.createDrawer.quantity }}</p>
                        </div>
                    </div>
                    <div>
                        <label for="small-input" :class="styles.drawer.label">Категория</label>
                        <CategoryComponent :categories="categories" :drawer_class="styles.drawer.input"
                                           v-model="drawer.categoryProduct" @category-change="handleProductCategory"
                                           :class="errors.drawer.categoryProduct ? this.errorCheckInput  : styles.drawer.input "/>
                        <p v-if="errors.drawer.categoryProduct" class="mt-2 text-sm text-red-600 dark:text-red-500">
                            {{ messages.createDrawer.category }}</p>
                    </div>
                </div>
            </div>
            <div class="group mx-0 px-0 md:mx-2 md:px-2">
                <button type="button" @click="submitCreateForm" :class="styles.main.button_primary" class="mr-3.5">
                    Сохранить
                </button>
                <button type="button" :class="styles.main.button_light">Отменить</button>

                <div class="deleteCat pt-3">
                    <div class="flex flex-row">
                        <div class="icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect width="32" height="32" rx="16" fill="#F56C6C"/>
                                <path d="M11.1875 12.5H10.3125C10.1848 12.5 10.0799 12.459 9.99794 12.3771C9.91598 12.2951 9.875 12.1903 9.875 12.0625C9.875 11.9348 9.91598 11.8299 9.99794 11.7479C10.0799 11.666 10.1848 11.625 10.3125 11.625H13.8125V10.3125C13.8125 10.1848 13.8535 10.0799 13.9354 9.99794C14.0174 9.91598 14.1223 9.875 14.25 9.875H17.75C17.8778 9.875 17.9826 9.91598 18.0646 9.99794C18.1465 10.0799 18.1875 10.1848 18.1875 10.3125V11.625H21.6875C21.8153 11.625 21.9201 11.666 22.0021 11.7479C22.084 11.8299 22.125 11.9348 22.125 12.0625C22.125 12.1903 22.084 12.2951 22.0021 12.3771C21.9201 12.459 21.8153 12.5 21.6875 12.5H20.8125V21.6875C20.8125 21.8153 20.7715 21.9201 20.6896 22.0021C20.6076 22.084 20.5028 22.125 20.375 22.125H11.625C11.4973 22.125 11.3924 22.084 11.3104 22.0021C11.2285 21.9201 11.1875 21.8153 11.1875 21.6875V12.5ZM17.3125 11.625V10.75H14.6875V11.625H17.3125ZM12.0625 21.25H19.9375V12.5H12.0625V21.25ZM14.6875 19.5C14.5598 19.5 14.4549 19.459 14.3729 19.3771C14.291 19.2951 14.25 19.1903 14.25 19.0625V14.6875C14.25 14.5598 14.291 14.4549 14.3729 14.3729C14.4549 14.291 14.5598 14.25 14.6875 14.25C14.8153 14.25 14.9201 14.291 15.0021 14.3729C15.084 14.4549 15.125 14.5598 15.125 14.6875V19.0625C15.125 19.1903 15.084 19.2951 15.0021 19.3771C14.9201 19.459 14.8153 19.5 14.6875 19.5ZM17.3125 19.5C17.1848 19.5 17.0799 19.459 16.9979 19.3771C16.916 19.2951 16.875 19.1903 16.875 19.0625V14.6875C16.875 14.5598 16.916 14.4549 16.9979 14.3729C17.0799 14.291 17.1848 14.25 17.3125 14.25C17.4403 14.25 17.5451 14.291 17.6271 14.3729C17.709 14.4549 17.75 14.5598 17.75 14.6875V19.0625C17.75 19.1903 17.709 19.2951 17.6271 19.3771C17.5451 19.459 17.4403 19.5 17.3125 19.5Z"
                                      fill="white"/>
                            </svg>
                        </div>
                        <span class="px-2 self-center text-sm text-[#303133]">Удалить позицию</span>
                    </div>
                </div>
            </div>
        </form>
    </DrawerComponent>
</template>

<script>
import InputSearchComponent from "../../../Shared/Components/InputSearchComponent.vue";
import DrawerComponent from "../../../Shared/Components/DrawerComponent.vue";
import CategoryComponent from "../../../Shared/Components/CategoryComponent.vue";
import styles from "./../../../components/config/styles";
import messages from "./../../../components/config/messages";
import {getProducts, getCategories} from './../../../components/scripts/http/axios'


export default {
    name: "Dishes",
    components: {DrawerComponent, InputSearchComponent, CategoryComponent},
    data() {
        return {
            symbol: " ₽",
            categories: [],
            products: [],
            searchQuery: '', // Запрос для поиска
            filteredProducts: [], // Массив отфильтрованных продуктов
            selectedCategory: "", // Выбранная категория
            errors: {
                drawer: {
                    isSubmitting: false,
                    namePosition: false,
                    price: false,
                    quantity: false,
                    selectedFile: false,
                    categoryProduct: false,
                }
            },
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
        messages() {
            return messages
        },
        styles() {
            return styles
        },
        errorCheckInput() {
            return styles.drawer.input + ' bg-red-50 border border-red-500 text-red-900 placeholder-red-700 rounded text-sm focus:ring-red-500';
        },
        filteredProducts() {
            let filteredProducts = this.products;
            if (this.searchQuery) {
                filteredProducts = filteredProducts.filter(product => product.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
            }
            if (this.selectedCategory) {
                filteredProducts = filteredProducts.filter(product => product.categories_id == this.selectedCategory);
            }
            return filteredProducts;
        },
        hasErrors() {
            return this.errors.drawer.namePosition || this.errors.drawer.price || this.errors.drawer.quantity || this.errors.drawer.selectedFile || this.errors.drawer.categoryProduct;
        }

    },
    watch: {
        'drawer.namePosition'() {
            if (this.errors.drawer.isSubmitting) this.validateNamePosition();
        },
        'drawer.price'() {
            if (this.errors.drawer.isSubmitting) this.validatePrice();
        },
        'drawer.quantity'() {
            if (this.errors.drawer.isSubmitting) this.validateQuantity();
        },
        'drawer.categoryProduct'() {
            if (this.errors.drawer.isSubmitting) this.validateCategory();
        },
        'drawer.selectedFile'() {
            if (this.errors.drawer.isSubmitting) this.validatePhoto();
        }
    },
    methods: {
        getProducts, getCategories,
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
        submitCreateForm(event) {
            this.errors.drawer.isSubmitting = true;
            this.validateNamePosition();
            this.validatePhoto();
            this.validatePrice();
            this.validateQuantity();
            this.validateCategory();
            if (!this.hasErrors) { // check if there are errors in drawer
                // axios
                console.log("Request");
            }

        },
        loadProducts() {
            // Загрузка данных о продуктах с сервера
            // и сохранение их в this.products
            getProducts()
                .then((products) => {
                    this.products = products;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        loadCategories() {
            // Загрузка данных о категориях с сервера
            // и сохранение их в this.categories
            getCategories()
                .then((category) => {
                    this.categories = category;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleProductCategory(categoryId) {
            let cat = this.categories.find(category => category.id === categoryId);
            return this.drawer.categoryProduct = cat;
        },
        getCategoryNameById(categoryId) {
            let category = this.categories.find(category => category.id === categoryId);
            return category ? category.name : '';
        },

        validateNamePosition() {
            this.errors.drawer.namePosition = this.drawer.namePosition === null || this.drawer.namePosition.length < 3;
        },
        validatePrice() {
            this.errors.drawer.price = this.drawer.price === null || this.drawer.price < 0;
        },
        validateQuantity() {
            this.errors.drawer.quantity = this.drawer.quantity === null || this.drawer.quantity < 0;
        },
        validateCategory() {
            let categProd = this.drawer.categoryProduct;
            this.errors.drawer.categoryProduct = categProd // 👈 null and undefined check
                && Object.keys(categProd).length === 0
                && Object.getPrototypeOf(categProd) === Object.prototype
                || (this.drawer.categoryProduct == ""
                && this.drawer.categoryProduct == undefined);
        },
        validatePhoto() {
            this.errors.drawer.selectedFile = this.drawer.selectedFileName === null || this.drawer.selectedFileName.length <= 0
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