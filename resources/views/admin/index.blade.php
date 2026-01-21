<x-app-layout>
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

                    {{-- Start alert doing --}}
                    {{-- end alert doing --}}

                    {{-- start component toggle form create product --}}


                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none"
                        type="button">
                        Toggle modal
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div
                                class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                                    <h3 class="text-lg font-medium text-heading">
                                        Terms of Service
                                    </h3>
                                    <button type="button"
                                        class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="default-modal">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="space-y-4 md:space-y-6 py-4 md:py-6">
                                    <p class="leading-relaxed text-body">
                                        With less than a month to go before the European Union enacts new consumer
                                        privacy laws for its citizens, companies around the world are updating their
                                        terms of service agreements to comply.
                                    </p>
                                    <p class="leading-relaxed text-body">
                                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into
                                        effect on May 25 and is meant to ensure a common set of data rights in the
                                        European Union. It requires organizations to notify users as soon as possible of
                                        high-risk data breaches that could personally affect them.
                                    </p>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center border-t border-default space-x-4 pt-4 md:pt-5">
                                    <button data-modal-hide="default-modal" type="button"
                                        class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">I
                                        accept</button>
                                    <button data-modal-hide="default-modal" type="button"
                                        class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Decline</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- end component toggle form create product --}}

                    {{-- start component table --}}
                    <div
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default rounded-sm">
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
