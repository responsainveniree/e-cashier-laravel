    <x-app-layout>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

                        <!-- Modal toggle -->
                        <button
                            class="rounded-md mb-2 bg-white text-black box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none"
                            x-on:click="btnCreateProduct" x-show="isVisible == 'card-table'" type="button">
                            New Products
                        </button>

                        <!-- Main modal -->
                        <div tabindex="-1" x-show="isVisible == 'create-product'"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            @click.self="closeCreateProduct" x-on:keydown.escape.window="closeCreateProduct"
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
                                        <button type="button" @click="closeCreateProduct"
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
                                                        placeholder="Product name">
                                                </div>

                                                <!-- Quantity -->
                                                <div class="col-span-2 md:col-span-1">
                                                    <label for="quantity"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Quantity</label>
                                                    <select x-model="product.quantity" id="quantity"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5">
                                                        <template x-for="index in 10" :key="index">
                                                            <option :value="index" x-text="index"></option>
                                                        </template>
                                                    </select>
                                                </div>

                                                <!-- Size -->
                                                <div class="col-span-2 md:col-span-1">
                                                    <label for="size"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Size</label>
                                                    <input type="text" x-model="product.size" id="size"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5"
                                                        placeholder="Size (ex: XL, 42)">
                                                </div>

                                                <!-- Category -->
                                                <div class="col-span-2 md:col-span-1">
                                                    <label for="category"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Category</label>
                                                    <select x-model="product.stock" id="category"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5">
                                                        <option value="">Select category</option>
                                                        <option value="TV">TV/Monitors</option>
                                                        <option value="PC">PC</option>
                                                        <option value="GA">Gaming/Console</option>
                                                        <option value="PH">Phones</option>
                                                    </select>
                                                </div>

                                                <!-- Description - Full width -->
                                                <div class="col-span-2 w-full">
                                                    <label for="description"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Product
                                                        Description</label>
                                                    <textarea id="description" rows="4" x-model="product.description"
                                                        class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5"
                                                        placeholder="Write product description here"></textarea>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Footer buttons tetap sama -->
                                        <div
                                            class="flex items-center justify-end space-x-3 border-t border-gray-200 dark:border-gray-700 pt-4 md:pt-6 gap-2">
                                            <button type="button" @click="closeCreateProduct"
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
