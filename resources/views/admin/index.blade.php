    <x-app-layout>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </x-slot>

        <div class="py-12" x-data="stateListProduct()">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-2 font-bold text-lg">
                            Halaman Admin Dashboard
                        </div>

                        <!-- Error Modal -->
                        <div x-show="errorObject.isError" x-transition @click.self="closeError"
                            class="fixed inset-0 z-70 flex items-center justify-center bg-black bg-opacity-50">

                            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-sm shadow-lg">
                                <div class="flex items-center gap-3 mb-3">
                                    <!-- Icon Error -->
                                    <div
                                        class="shrink-0 w-10 h-10 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>

                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Error
                                        <span x-show="errorObject.errorStatus"
                                            x-text="'(' + errorObject.errorStatus + ')'" class="text-sm text-gray-500">
                                        </span>
                                    </h3>
                                </div>

                                <p class="text-gray-700 dark:text-gray-300 mb-6" x-text="errorObject.errorMessage">
                                </p>

                                <div class="flex justify-end">
                                    <button @click="closeError"
                                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                                        OK
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Warning Modal -->
                        <div x-show="warningObject.isWarning" x-transition @click.self="cancelWarning"
                            class="fixed inset-0 z-60 flex items-center justify-center bg-black bg-opacity-50">

                            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-sm shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                    Konfirmasi
                                </h3>

                                <p class="text-gray-700 dark:text-gray-300 mb-6" x-text="warningObject.warningMessage">
                                </p>

                                <div class="flex justify-end gap-2">
                                    <button @click="cancelWarning"
                                        class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500">
                                        Batal
                                    </button>

                                    <button @click="confirmWarning()"
                                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                                        Ya, tutup
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal toggle -->
                        <button
                            class="rounded-md mb-2 bg-white text-black box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none"
                            x-on:click="btnCreateProduct" x-show="isVisible == 'card-table'" type="button">
                            New Products
                        </button>

                        <!-- Create modal -->
                        <div tabindex="-1" x-show="isVisible == 'create-product'"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            @click.self="closeCreateUpdateModal" x-on:keydown.escape.window="closeCreateUpdateModal"
                            class="w-full overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center h-full bg-gray-900 bg-opacity-50">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <div
                                    class="relative bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg p-4 md:p-6">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4 md:pb-5">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            Create new product
                                        </h3>
                                        <!-- Tombol X - HAPUS data-modal-hide, TAMBAH @click Alpine -->
                                        <button type="button" @click="closeCreateUpdateModal"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-700 dark:hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
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
                                                        placeholder="Product name" required>
                                                </div>

                                                <!-- Quantity -->
                                                <div class="col-span-2 md:col-span-1">
                                                    <label for="quantity"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Quantity</label>
                                                    <select x-model.number="product.quantity" id="quantity"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                                        text-gray-900 dark:text-gray-100 text-sm rounded-lg
                                                        focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5"
                                                        required>
                                                        <template x-for="index in 10" :key="index">
                                                            <option :value="index" x-text="index"></option>
                                                        </template>
                                                    </select>
                                                </div>


                                                <!-- Size -->
                                                <div class="col-span-2 md:col-span-1">
                                                    <label for="size"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Size</label>
                                                    <select x-model="product.size" id="size"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5"
                                                        required>
                                                        <template x-for="(label, key) in listSize"
                                                            :key="key">
                                                            <option :value="key" x-text="label"></option>
                                                        </template>
                                                    </select>

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
                                                        placeholder="Product price" required>
                                                </div>

                                                <!-- Description - Full width -->
                                                <div class="col-span-2 w-full">
                                                    <label for="description"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Product
                                                        Description</label>
                                                    <textarea id="description" rows="4" x-model="product.description"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5"
                                                        placeholder="Write product description here" required></textarea>
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
                                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                                Add product
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Edit Product --}}
                        <div tabindex="-1" x-show="isVisible == 'edit-product'"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            @click.self="closeCreateUpdateModal" x-on:keydown.escape.window="closeCreateUpdateModal"
                            class="w-full overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center h-full bg-gray-900 bg-opacity-50">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <div
                                    class="relative bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg p-4 md:p-6">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4 md:pb-5">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            Edit product
                                        </h3>
                                        <!-- Tombol X - HAPUS data-modal-hide, TAMBAH @click Alpine -->
                                        <button type="button" @click="closeCreateUpdateModal"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-700 dark:hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                                            <svg class="w-5 h-5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
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
                                                        placeholder="Product name" required>
                                                </div>

                                                <!-- Quantity -->
                                                <div class="col-span-2 md:col-span-1">
                                                    <label for="quantity"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Quantity</label>
                                                    <select x-model.number="product.quantity" id="quantity"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600
                                                        text-gray-900 dark:text-gray-100 text-sm rounded-lg
                                                        focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5"
                                                        required>
                                                        <template x-for="index in 10" :key="index">
                                                            <option :value="index" x-text="index"></option>
                                                        </template>
                                                    </select>
                                                </div>


                                                <!-- Size -->
                                                <div class="col-span-2 md:col-span-1">
                                                    <label for="size"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Size</label>
                                                    <select x-model="product.size" id="size"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5"
                                                        required>
                                                        <template x-for="(label, key) in listSize"
                                                            :key="key">
                                                            <option :value="key" x-text="label"></option>
                                                        </template>
                                                    </select>

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
                                                        placeholder="Product price" required>
                                                </div>

                                                <!-- Description - Full width -->
                                                <div class="col-span-2 w-full">
                                                    <label for="description"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Product
                                                        Description</label>
                                                    <textarea id="description" rows="4" x-model="product.description"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5"
                                                        placeholder="Write product description here" required></textarea>
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
                                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                                Add product
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- start component table --}}
                        <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default rounded-sm"
                            x-show="isVisible == 'card-table'">
                            @include('admin._card_table')
                            <div class="flex gap-2 mt-4 mb-2 justify-center">
                                <button :disabled="!prevPage" @click="fetchProducts(currentPage - 1)"
                                    class="px-4 bg-blue-600 dark:bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition disabled:bg-gray-500">
                                    Prev
                                </button>
                                <span x-text="`Page ${currentPage} of ${lastPage}`"></span>
                                <button :disabled="!nextPage" @click="fetchProducts(currentPage + 1)"
                                    class="px-4 bg-blue-600 dark:bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition disabled:bg-gray-500">
                                    Next
                                </button>
                            </div>

                        </div>
                        {{-- End component table --}}
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
