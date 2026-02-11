<!-- Modal Stock Table -->
<div x-show="isVisible == 'stock-table'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">

    <!-- Backdrop/Overlay -->
    <div class="fixed inset-0 bg-dark-500 bg-opacity-75 transition-opacity" @click="closeStockModal()"></div>

    <!-- Modal Container -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-lg bg-gray-700 shadow-xl transition-all w-full max-w-4xl">

            <!-- Modal Header -->
            <div class="bg-gray-700 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900" id="modal-title">
                            Stock Details
                        </h3>
                        <p class="text-sm text-gray-500 mt-1" x-text="'Product: ' + selectedProduct.name">
                            Product: Dummy
                        </p>
                    </div>
                    <button type="button" @click="closeStockModal()"
                        class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body with Table -->
            <div class="bg-gray-700 px-6 py-4 max-h-150 overflow-y-auto">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead
                        class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default sticky top-0">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Stock ID
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Created By
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-if="selectedProduct.stocks && selectedProduct.stocks.length > 0">
                            <template x-for="stock in selectedProduct.stocks" :key="stock.id">
                                <tr class="bg-neutral-primary border-b border-default hover:bg-gray-50">
                                    <td scope="row"
                                        class="px-6 text-left py-4 font-medium text-heading whitespace-nowrap"
                                        x-text="stock.id">
                                    </td>
                                    <td class="px-6 text-left py-4" x-text="stock.quantity">
                                    </td>
                                    <td class="px-6 text-left py-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full"
                                            :class="stock.status === 'available' ? 'bg-green-100 text-green-800' :
                                                'bg-red-100 text-red-800'"
                                            x-text="stock.status || 'available'">
                                        </span>
                                    </td>
                                    <td class="px-6 text-left py-4" x-text="stock.created_by || 'Admin'">
                                    </td>
                                    <td class="px-6 text-left py-4">
                                        <div class="flex gap-2">
                                            <button
                                                class="rounded-md bg-white text-black box-border border border-gray-300 hover:bg-gray-50 focus:ring-4 focus:ring-blue-200 shadow-xs text-sm px-3 py-2 focus:outline-none"
                                                @click="buttonEditStock(stock)" type="button">
                                                Edit
                                            </button>
                                            <button
                                                class="rounded-md bg-red-50 text-red-600 box-border border border-red-200 hover:bg-red-100 focus:ring-4 focus:ring-red-200 shadow-xs text-sm px-3 py-2 focus:outline-none"
                                                @click="btnDeleteStock(stock.id)" type="button">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>

                        <!-- Empty State -->
                        <template x-if="!selectedProduct.stocks || selectedProduct.stocks.length === 0">
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">No stock data available</p>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-700 px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                <button type="button" @click="btnAddNewStock()"
                    class="inline-flex justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Stock
                </button>

                <button type="button" @click="closeStockModal()"
                    class="inline-flex justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
