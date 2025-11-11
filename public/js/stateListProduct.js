function stateListProduct() {
    return {
        listProduct: [],
        init() {
            this.getListProduct();
        },
        async getListProduct() {
            try {
                const result = await axios.get("list-products");

                this.listProduct = result.data.data;

                console.log("data dari BE", this.listProduct);
            } catch (error) {
                console.log("error", error);
            }
        },
    };
}
