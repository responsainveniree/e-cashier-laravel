<table class="w-full text-sm text-left rtl:text-right text-body">
    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
        <tr>
            <th scope="col" class="px-6 py-3 font-medium">
                ID
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Product name
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Price
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Size
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Total Quantity
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
        <template x-if="listProduct.length > 0 "> <template x-for="product in listProduct" :key="product.id">
                <tr class="bg-neutral-primary border-b border-default">
                    <td scope="row" class="px-6 text-left py-4 font-medium text-heading whitespace-nowrap"
                        x-text="product.id">
                    </td>
                    <td class="px-6 text-left py-4" x-text="product.name">
                    </td>
                    <td class="px-6 text-left py-4">
                        <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(product.price)"></span>
                    </td>
                    <td class="px-6 text-left py-4" x-text="product.size">
                    </td>
                    <td class="px-6 text-left py-4" x-text="product.stocks_sum_quantity">
                    </td>
                    <td class="px-6 text-left py-4">
                        <div class="flex items-center gap-2">
                            <span x-text="product.stocks.length"></span>
                            <div @click="btnStocksInfo">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 416.979 416.979">
                                    <path
                                        d="M356.004,61.156c-81.37-81.47-213.377-81.551-294.848-0.182c-81.47,81.371-81.552,213.379-0.181,294.85 c81.369,81.47,213.378,81.551,294.849,0.181C437.293,274.636,437.375,142.626,356.004,61.156z M237.6,340.786 c0,3.217-2.607,5.822-5.822,5.822h-46.576c-3.215,0-5.822-2.605-5.822-5.822V167.885c0-3.217,2.607-5.822,5.822-5.822h46.576 c3.215,0,5.822,2.604,5.822,5.822V340.786z M208.49,137.901c-18.618,0-33.766-15.146-33.766-33.765 c0-18.617,15.147-33.766,33.766-33.766c18.619,0,33.766,15.148,33.766,33.766C242.256,122.755,227.107,137.901,208.49,137.901z" />
                                </svg>
                            </div>

                        </div>
                    </td>
                    <td class="px-6 text-left py-4">
                        <div class="flex gap-2">
                            <button
                                class="rounded-md bg-white text-black box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-sm shadow-xs rounded-base text-sm px-3 py-2 focus:outline-none"
                                @click="buttonEditProduct(product)" type="button">
                                Edit
                            </button>
                            <button
                                class="rounded-md bg-white text-black box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-sm shadow-xs rounded-base text-sm px-3 py-2 focus:outline-none"
                                @click="btnDeleteProduct(product.id)" type="button">
                                Delete
                            </button>
                        </div>

                    </td>
                </tr>
            </template> </template>

    </tbody>
</table>
