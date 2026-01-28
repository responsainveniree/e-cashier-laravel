function stateListProduct(page = 1) {
    return {
        listProduct: [],
        currentPage: page,
        lastPage: 1,
        nextPage: null,
        prevPage: null,

        //Membuat name objek dan propertinya
        product: {
            name: "",
            price: "",
            quantity: 1,
            size: "",
            description: "",
        },

        listSize: {small: 'Small', medium: 'Medium', large: 'Large'},

        errorObject: {
            isError: false,
            errorMessage: "",
        },

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


        // menambahkan properti untuk menampilkan / menutup card setiap component
        isVisible: "card-table",

        btnCreateProduct() {
            this.isVisible = "create-product";
        },

        cancelWarning() {
            this.warningObject.isWarning = false;
        },


        closeCreateProduct() {
            const isAnyData = Object.values(this.product).some(
                value => value !== "" // tambah check untuk quantity default
            );

            if (isAnyData) {
                this.warningObject.isWarning = true;
                this.warningObject.warningMessage = "Masih ada data, yakin mau ditutup?";
                return;
            }

            this.resetField();
            this.isVisible = "card-table";
        },


        resetField() {
            Object.assign(this.product, {
                name: "",
                price: "",
                quantity: 1,
                size: "",
                description: "",
            });
        },

        async sendDataProduct() {
            console.log(this.product)
            try {
                await axios.post("post-product", this.product);


                this.resetField();
                this.isVisible = "card-table";
                this.fetchProducts(this.currentPage); // optional: refresh table
            } catch (error) {
                console.error("Gagal simpan produk:", error);
                alert("Gagal menyimpan produk. Cek data atau server.");
            }
        },

        sizeFormatter: {
            small: 'S',
            medium: 'M',
            large: 'L',
        },

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
