<div tabindex="-1" x-show="isVisible == 'create-product'" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" @click.self="closeCreateUpdateModal"
    x-on:keydown.escape.window="closeCreateUpdateModal"
    class="w-full overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div
            class="relative bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg p-4 md:p-6">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Create new product
                </h3>
                <!-- Tombol X - HAPUS data-modal-hide, TAMBAH @click Alpine -->
                <button type="button" @click="closeCreateUpdateModal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-700 dark:hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form @submit.prevent="sendDataProduct">
                <div class="py-4 md:py-6 px-2">
                    <!-- Grid 2 kolom -->
                    <div class="grid grid-cols-2 gap-4">

                        <!-- Name -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Name</label>
                            <input type="text" x-model="product.name" id="name"
                                class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5"
                                placeholder="Product name">
                            <template x-if="errors.name.length > 0">
                                <p class="mt-2.5 text-sm text-red-500" x-text="errors.name">
                                </p>
                            </template>
                        </div>



                        <!-- Quantity -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="quantity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Quantity</label>
                            <select x-model.number="product.quantity" id="quantity"
                                class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                                        text-gray-900 dark:text-gray-100 text-sm rounded-lg
                                                        focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5">
                                <template x-for="index in 10" :key="index">
                                    <option :value="index" x-text="index"></option>
                                </template>
                            </select>
                            <template x-if="errors.quantity.length > 0">
                                <p class="mt-2.5 text-sm text-red-500" x-text="errors.quantity">
                                </p>
                            </template>
                        </div>


                        <!-- Size -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="size"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Size</label>
                            <select x-model="product.size" id="size"
                                class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5">
                                <template x-for="(label, key) in listSize" :key="key">
                                    <option :value="key" x-text="label"></option>
                                </template>
                            </select>
                            <template x-if="errors.size.length > 0">
                                <p class="mt-2.5 text-sm text-red-500" x-text="errors.size">
                                </p>
                            </template>
                        </div>

                        <!-- Price -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                Price
                            </label>
                            <input type="number" x-model="product.price" id="price"
                                class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                                                text-gray-900 dark:text-gray-100 text-sm rounded-lg
                                                                focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5"
                                placeholder="Product price">
                            <template x-if="errors.price.length > 0">
                                <p class="mt-2.5 text-sm text-red-500" x-text="errors.price">
                                </p>
                            </template>
                        </div>

                        <!-- Description - Full width -->
                        <div class="col-span-2 w-full">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Product
                                Description</label>
                            <textarea id="description" rows="4" x-model="product.description"
                                class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5"
                                placeholder="Write product description here"></textarea>
                            <template x-if="errors.description.length > 0">
                                <p class="mt-2.5 text-sm text-red-500" x-text="errors.description">
                                </p>
                            </template>
                        </div>

                    </div>
                </div>

                <!-- Footer buttons tetap sama -->
                <div
                    class="flex items-center justify-end space-x-3 border-t border-gray-200 dark:border-gray-700 pt-4 md:pt-6 gap-2">
                    <button type="button" @click="closeCreateUpdateModal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 border border-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white">
                        Cancel
                    </button>
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                        :disabled="isLoading">

                        <template x-if="isLoading">
                            <svg aria-hidden="true" role="status" class="w-4 h-4 me-2 text-white animate-spin"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor" />
                            </svg>
                        </template>


                        <svg x-show="!isLoading" class="w-4 h-4 me-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>

                        <span x-text="isLoading ? 'Loading...' : 'Add Product'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
