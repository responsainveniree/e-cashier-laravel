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
        <template x-if="listProduct.length > 0 "> <template x-for="product in listProduct"
                :key="product.id">
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
            </template> </template>

    </tbody>
</table>
