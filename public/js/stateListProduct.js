function stateListProduct(page = 1) {
    return {
        listProduct: [],
        currentPage: page,
        lastPage: 1,
        nextPage: null,
        prevPage: null,

        // ID disimpan terpisah untuk menghindari reactivity issue
        editProduct: {
            id: null,
            name: "",
            price: "",
            quantity: 1,
            size: "small",
            description: "",
        },

        product: {
            id: null,
            name: "",
            price: "",
            quantity: 1,
            size: "small",
            description: "",
        },

        deleteProductId: null,

        // size
        listSize: { small: "Small", medium: "Medium", large: "Large" },

        // Error
        errorObject: {
            isError: false,
            errorMessage: "",
            errorStatus: null,
        },

        errors: {
            name: "",
            price: "",
            quantity: "",
            size: "",
            description: "",
        },

        closeError() {
            this.errorObject.isError = false;
            this.errorObject.errorMessage = "";
            this.errorObject.errorStatus = null;
        },

        // Warning
        warningObject: {
            warningType: "",
            isWarning: false,
            warningMessage: "",
            confirmWarning: false,
        },

        confirmWarning() {
            if (this.warningObject.warningType == "createUpdateModal") {
                this.resetField();
                this.warningObject.isWarning = false;
                this.warningObject.confirmWarning = false;
                this.isVisible = "card-table";
            } else if (this.warningObject.warningType == "deleteProductModal") {
                this.deleteDataProduct();
                this.warningObject.isWarning = false;
                this.warningObject.confirmWarning = false;
                this.isVisible = "card-table";
            }
        },

        cancelWarning() {
            this.warningObject.isWarning = false;
        },

        // Visible logic
        isVisible: "card-table",

        btnDeleteProduct(productId) {
            this.deleteProductId = productId;
            this.warningObject.isWarning = true;
            this.warningObject.warningMessage =
                "Yakin ingin menghapus product ini?";
            this.warningObject.warningType = "deleteProductModal";
        },

        // Button CRUD
        btnCreateProduct() {
            this.resetField(); // Reset dulu sebelum buka modal create
            this.isVisible = "create-product";
        },

        buttonEditProduct(productData) {
            const cleanData = JSON.parse(JSON.stringify(productData));

            console.log("check clean data:", cleanData);

            // Simpan data ke editProduct (untuk form edit)
            this.editProduct = {
                id: cleanData.id,
                name: cleanData.name,
                price: cleanData.price,
                quantity: cleanData.quantity,
                size: cleanData.size,
                description: cleanData.description,
            };

            this.product = {
                id: cleanData.id,
                name: cleanData.name,
                price: cleanData.price,
                quantity: cleanData.quantity,
                size: cleanData.size,
                description: cleanData.description,
            };

            console.log("editProduct set:", this.editProduct);

            // Ubah visibility
            this.isVisible = "edit-product";
        },

        closeCreateUpdateModal(_warningType) {
            // Cek apakah ada data yang diisi
            const isAnyData =
                this.product.name !== "" ||
                this.product.price !== "" ||
                this.product.description !== "";

            if (isAnyData) {
                this.warningObject.isWarning = true;
                this.warningObject.warningMessage =
                    "Masih ada data, yakin mau ditutup?";
                this.warningObject.warningType = "createUpdateModal";
                return;
            }

            this.resetField();
            this.isVisible = "card-table";
        },

        //Open stocks info
        btnStocksInfo() {
            this.isVisible = "stock-table";
        },

        closeStockModal() {
            this.isVisible = "card-table";
        },

        listStocks: [],

        resetField() {
            // Reset editProduct
            Object.assign(this.editProduct, {
                id: null,
                name: "",
                price: "",
                quantity: 1,
                size: "small",
                description: "",
            });
            // Reset product (untuk create form)
            Object.assign(this.product, {
                id: null,
                name: "",
                price: "",
                quantity: 1,
                size: "small",
                description: "",
            });
        },

        async deleteDataProduct() {
            try {
                await axios.delete(`/delete-product/${this.deleteProductId}`);

                this.fetchProducts(this.currentPage);
            } catch (error) {
                if (error.response) {
                    const status = error.response.status;
                    const errorData = error.response.data.errors;

                    Object.keys(this.errors).forEach(
                        (key) => (this.errors[key] = ""),
                    );

                    switch (status) {
                        case 404:
                            this.errorObject.errorMessage = "Product not found";
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                            break;
                        case 422:
                            for (data in errorData) {
                                this.errors[data] = errorData[data][0];
                            }
                            break;
                        case 500:
                            this.errorObject.errorMessage =
                                "Internal server error: " +
                                error.response.data.message;
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                            break;
                        case 401:
                            this.errorObject.errorMessage =
                                "You're not authorized";
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                            break;
                        default:
                            this.errorObject.errorMessage =
                                error.response.data.message ||
                                "Something went wrong";
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                    }
                } else {
                    this.errorObject.isError = true;
                    this.errorObject.errorMessage =
                        "Couldn't connect to the server";
                }
            }
        },

        async sendDataProduct() {
            try {
                const newProduct = {
                    name: this.product.name,
                    price: Number(this.product.price),
                    quantity: Number(this.product.quantity),
                    size: this.product.size,
                    description: this.product.description,
                };

                await axios.post("post-product", newProduct);
                this.resetField();
                this.isVisible = "card-table";
                this.fetchProducts(this.currentPage);
            } catch (error) {
                if (error.response) {
                    const status = error.response.status;
                    const errorData = error.response.data.errors;

                    Object.keys(this.errors).forEach(
                        (key) => (this.errors[key] = ""),
                    );

                    switch (status) {
                        case 422:
                            for (data in errorData) {
                                this.errors[data] = errorData[data][0];
                            }
                            break;
                        case 500:
                            this.errorObject.errorMessage =
                                "Internal server error: " +
                                error.response.data.message;
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                            break;
                        case 401:
                            this.errorObject.errorMessage =
                                "You're not authorized";
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                            break;
                        default:
                            this.errorObject.errorMessage =
                                error.response.data.message ||
                                "Something went wrong";
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                    }
                } else {
                    this.errorObject.isError = true;
                    this.errorObject.errorMessage =
                        "Couldn't connect to the server";
                }
            }
        },

        async editDataProduct() {
            try {
                // Gunakan editProduct sepenuhnya
                const dataToSend = {
                    id: this.editProduct.id,
                    name: this.editProduct.name,
                    price: Number(this.editProduct.price),
                    size: this.editProduct.size,
                    description: this.editProduct.description,
                };

                await axios.patch("edit-product", dataToSend);

                this.isVisible = "card-table";
                this.fetchProducts(this.currentPage);

                console.log("Product updated successfully");
            } catch (error) {
                if (error.response) {
                    const status = error.response.status;
                    const errorData = error.response.data.errors;

                    Object.keys(this.errors).forEach(
                        (key) => (this.errors[key] = ""),
                    );

                    switch (status) {
                        case 404:
                            this.errorObject.errorMessage = "Product not found";
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                            break;
                        case 422:
                            for (data in errorData) {
                                this.errors[data] = errorData[data][0];
                            }
                            break;
                        case 500:
                            this.errorObject.errorMessage =
                                "Internal server error: " +
                                error.response.data.message;
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                            break;
                        case 401:
                            this.errorObject.errorMessage =
                                "You're not authorized";
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                            break;
                        default:
                            this.errorObject.errorMessage =
                                error.response.data.message ||
                                "Something went wrong";
                            this.errorObject.errorStatus = status;
                            this.errorObject.isError = true;
                    }
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

                console.log(result);

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
