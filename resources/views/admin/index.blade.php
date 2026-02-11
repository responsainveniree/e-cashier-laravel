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
                        @include('components.modals.error-modal')

                        <!-- Warning Modal -->
                        @include('components.modals.warning-modal')

                        <!-- Modal toggle -->
                        <button
                            class="rounded-md mb-2 bg-white text-black box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none"
                            x-on:click="btnCreateProduct" x-show="isVisible == 'card-table'" type="button">
                            New Products
                        </button>

                        <!-- Create modal -->
                        @include('admin._create_modal')

                        {{-- Edit Product --}}
                        @include('admin._edit_modal')

                        {{-- Stock Modal --}}
                        @include('admin._stock_table')

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
