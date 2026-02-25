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

        stockProductId: null,

        isLoading: false,

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

        clearErrors() {
            // Clear field validation errors
            Object.keys(this.errors).forEach((key) => {
                this.errors[key] = "";
            });

            // Clear general error object
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

        // Button CRUD
        btnDeleteProduct(productId) {
            this.deleteProductId = productId;
            this.warningObject.isWarning = true;
            this.warningObject.warningMessage =
                "Yakin ingin menghapus product ini?";
            this.warningObject.warningType = "deleteProductModal";
        },

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
        btnStocksInfo(stockProductId, productName) {
            this.isVisible = "stock-table";
            this.stockProductId = stockProductId;
            this.selectedProduct.name = productName;

            this.fetchProductStocks();
        },

        closeStockModal() {
            this.isVisible = "card-table";
        },

        selectedProduct: {
            name: "",
            stocks: [],
        },

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
                this.isLoading = true;

                const res = await axios.delete(
                    `/delete-product/${this.deleteProductId}`,
                );

                if (res.status === 200) {
                    swalSuccess(res.data.message);
                }

                this.fetchProducts(this.currentPage);
            } catch (error) {
                errorHandler(error, this);
            } finally {
                this.isLoading = false;
            }
        },

        async sendDataProduct() {
            try {
                this.clearErrors();

                this.isLoading = true;

                const newProduct = {
                    name: this.product.name,
                    price: Number(this.product.price),
                    quantity: Number(this.product.quantity),
                    size: this.product.size,
                    description: this.product.description,
                };

                const res = await axios.post("post-product", newProduct);
                this.resetField();

                if (res.status === 201) {
                    swalSuccess(res.data.message);
                }

                this.isVisible = "card-table";
                this.fetchProducts(this.currentPage);
            } catch (error) {
                errorHandler(error, this);
            } finally {
                this.isLoading = false;
            }
        },

        async editDataProduct() {
            try {
                this.clearErrors();

                this.isLoading = true;

                // Gunakan editProduct sepenuhnya
                const dataToSend = {
                    id: this.editProduct.id,
                    name: this.editProduct.name,
                    price: Number(this.editProduct.price),
                    size: this.editProduct.size,
                    description: this.editProduct.description,
                };

                const res = await axios.patch("edit-product", dataToSend);

                if (res.status === 200) {
                    swalSuccess(res.data.message);
                }

                this.isVisible = "card-table";
                this.fetchProducts(this.currentPage);
            } catch (error) {
                errorHandler(error, this);
            } finally {
                this.isLoading = false;
            }
        },

        sizeFormatter: {
            small: "S",
            medium: "M",
            large: "L",
        },

        async fetchProducts(page = 1) {
            try {
                const response = await axios.get("list-products?page=" + page);
                const res = response.data.data;

                this.listProduct = res.data;
                this.currentPage = res.current_page;
                this.lastPage = res.last_page;
                this.nextPage = res.next_page_url;
                this.prevPage = res.prev_page_url;
            } catch (error) {
                console.log("error", error);
            }
        },

        // Stock
        async fetchProductStocks() {
            try {
                const productId = Number(this.stockProductId);

                const response = await axios.get(
                    `/list-product-stocks/${productId}`,
                );

                const res = response;

                this.selectedProduct.name = res.data.name;
                this.selectedProduct.stocks = res.data.stockProducts;
            } catch (error) {
                console.log("error", error);
            }
        },

        init() {
            this.fetchProducts(this.currentPage);
        },
    };
}
