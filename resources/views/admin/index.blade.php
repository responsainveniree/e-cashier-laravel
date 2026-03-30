    <x-app-layout>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </x-slot>

        <div class="py-12" x-data="stateListProduct()">
            <template x-if="isLoading">
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70">
                    <div
                        class="text-white bg-brand inline-flex items-center box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                        <svg aria-hidden="true" role="status" class="w-4 h-4 me-2 text-white animate-spin"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>


            </template>
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

                        {{-- Create stock modal --}}
                        @include('admin._create_stock_modal')

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
