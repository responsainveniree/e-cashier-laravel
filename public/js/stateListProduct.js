function stateListProduct(page = 1) {
    return {
        listProduct: [],
        currentPage: page,
        lastPage: 1,
        nextPage: null,
        prevPage: null,

        async fetchProducts(page = 1) {
            try {
                const result = await axios.get("list-products?page=" + page);

                const res = result.data.data;
                this.listProduct = res.data; // array produk
                this.currentPage = res.current_page;
                this.lastPage = res.last_page;
                this.nextPage = res.next_page_url;
                this.prevPage = res.prev_page_url;

                console.log("produk:", this.listProduct);
            } catch (error) {
                console.log("error", error);
            }
        },

        init() {
            this.fetchProducts(this.currentPage);
        },
    };
}
