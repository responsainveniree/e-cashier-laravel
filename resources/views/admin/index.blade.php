<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
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
                    {{-- end component toggle form create product --}}

                    {{-- start component table --}}
                    <div
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default rounded-sm">
                        <table class="w-full text-sm text-left rtl:text-right text-body">
                            <thead
                                class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Code
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Size
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Stocks
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="product in listProduct" :key="product.id">
                                    <tr class="bg-neutral-primary border-b border-default">
                                        <td scope="row"
                                            class="px-6 text-center py-4 font-medium text-heading whitespace-nowrap"
                                            x-text="product.id">
                                        </td>
                                        <td class="px-6 text-center py-4" x-text="product.name">
                                        </td>
                                        <td class="px-6 text-center py-4" x-text="product.code">
                                        </td>
                                        <td class="px-6 text-center py-4">
                                            <span
                                                x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(product.price)"></span>
                                        </td>
                                        <td class="px-6 text-center py-4" x-text="product.size">
                                        </td>
                                        <td class="px-6 text-center py-4" x-text="product.stocks.length">
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    {{-- End component table --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
