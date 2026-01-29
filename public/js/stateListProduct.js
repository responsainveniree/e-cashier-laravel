function stateListProduct(page = 1) {
    return {
        listProduct: [],
        currentPage: page,
        lastPage: 1,
        nextPage: null,
        prevPage: null,

        product: {
            id: null, // ✅ Tambahkan ID
            name: "",
            price: "",
            quantity: 1,
            size: "small",
            description: "",
        },

        listSize: { small: "Small", medium: "Medium", large: "Large" },

        // Error
        errorObject: {
            isError: false,
            errorMessage: "",
            errorStatus: null,
        },

        closeError() {
            this.errorObject.isError = false;
            this.errorObject.errorMessage = "";
            this.errorObject.errorStatus = null;
        },

        // Warning
        warningObject: {
            isWarning: false,
            warningMessage: "",
            confirmWarning: false,
        },

        confirmWarning() {
            this.resetField();
            this.warningObject.isWarning = false;
            this.warningObject.confirmWarning = false;
            this.isVisible = "card-table";
        },

        cancelWarning() {
            this.warningObject.isWarning = false;
        },

        // Visible logic
        isVisible: "card-table",

        btnCreateProduct() {
            this.resetField(); // Reset dulu sebelum buka modal create
            this.isVisible = "create-product";
        },

        // ✅ Perbaiki function buttonEditProduct
        buttonEditProduct(product) {
            // Set semua data product ke form
            this.product.id = product.id;
            this.product.name = product.name;
            this.product.description = product.description;
            this.product.price = product.price;
            this.product.quantity = product.quantity;
            this.product.size = product.size;

            // Buka modal edit
            this.isVisible = "edit-product";

            console.log("Editing product:", this.product);
        },

        closeCreateUpdateModal() {
            // Cek apakah ada data yang diisi
            const isAnyData =
                this.product.name !== "" ||
                this.product.price !== "" ||
                this.product.description !== "";

            if (isAnyData) {
                this.warningObject.isWarning = true;
                this.warningObject.warningMessage =
                    "Masih ada data, yakin mau ditutup?";
                return;
            }

            this.resetField();
            this.isVisible = "card-table";
        },

        resetField() {
            Object.assign(this.product, {
                id: null, // ✅ Reset ID juga
                name: "",
                price: "",
                quantity: 1,
                size: "small",
                description: "",
            });
        },

        async sendDataProduct() {
            try {
                await axios.post("post-product", this.product);
                this.resetField();
                this.isVisible = "card-table";
                this.fetchProducts(this.currentPage);
            } catch (error) {
                if (error.response) {
                    const status = error.response.status;

                    switch (status) {
                        case 422:
                            this.errorObject.errorMessage =
                                "Data was not valid: " +
                                error.response.data.message;
                            break;
                        case 500:
                            this.errorObject.errorMessage =
                                "Internal server error: " +
                                error.response.data.message;
                            break;
                        case 401:
                            this.errorObject.errorMessage =
                                "You're not authorized";
                            break;
                        default:
                            this.errorObject.errorMessage =
                                error.response.data.message ||
                                "Something went wrong";
                    }

                    this.errorObject.errorStatus = status;
                    this.errorObject.isError = true;
                } else {
                    this.errorObject.isError = true;
                    this.errorObject.errorMessage =
                        "Couldn't connect to the server";
                }
            }
        },

        // ✅ Perbaiki editDataProduct
        async editDataProduct() {
            try {
                // Kirim data beserta ID
                await axios.post("edit-product", this.product);

                this.resetField();
                this.isVisible = "card-table";
                this.fetchProducts(this.currentPage);

                console.log("Product updated successfully");
            } catch (error) {
                if (error.response) {
                    const status = error.response.status;

                    switch (status) {
                        case 404:
                            this.errorObject.errorMessage = "Product not found";
                            break;
                        case 422:
                            this.errorObject.errorMessage =
                                "Data was not valid: " +
                                error.response.data.message;
                            break;
                        case 500:
                            this.errorObject.errorMessage =
                                "Internal server error: " +
                                error.response.data.message;
                            break;
                        case 401:
                            this.errorObject.errorMessage =
                                "You're not authorized";
                            break;
                        default:
                            this.errorObject.errorMessage =
                                error.response.data.message ||
                                "Something went wrong";
                    }

                    this.errorObject.errorStatus = status;
                    this.errorObject.isError = true;
                } else {
                    this.errorObject.isError = true;
                    this.errorObject.errorMessage =
                        "Couldn't connect to the server";
                }
            }
        },

        sizeFormatter: {
            small: "S",
            medium: "M",
            large: "L",
        },

        async fetchProducts(page = 1) {
            try {
                const result = await axios.get("list-products?page=" + page);
                const res = result.data.data;

                this.listProduct = res.data;
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
