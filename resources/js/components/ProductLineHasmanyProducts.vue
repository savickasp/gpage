<template>
    <table class="table">
        <thead>
        <tr>

            <th>Pavadinimas</th>
            <th>Produktų linija</th>
            <th>Veiksmai</th>
            <th>
                <input v-model="search">
                <button @click="findProducts" class="btn btn-primary">ieškoti</button>
                <button @click="findAssociated" class="btn btn-primary">ieškori susietų</button>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in products">
            <td>{{ product.name }}</td>
            <td>
                <template v-if="product.productline">{{ product.productline.name }}</template>
            </td>
            <td colspan="2">
                <button v-if="!product.productline"
                        @click="associateProduct(product.id)"
                        class="btn btn-primary">susieti
                </button>
                <button v-else-if="product.productline.id === productline.id"
                        @click="disassociateProduct(product.id)"
                        class="btn btn-danger">Atsieti
                </button>
                <span v-else>Produktas susietas su kita produktu linija.</span>
            </td>
        </tr>
        <tr v-show="!products.length">
            <td colspan="3">Nerasta produktų</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: 'product-line-hasmany-products',
        props: {
            productline: {
                type: [Object]
            }
        },
        created() {
            this.findAssociated();
        },
        methods: {
            findProducts: function (data) {
                axios.post('/api/product-line/' + this.productline.id + '/products/filter', data).then(data => {
                    this.products = data.data;
                });
            },
            findAssociated: function () {
                this.findProducts({ id: this.productline.id });
            },
            associateProduct: function (data) {
                axios.post('/api/product-line/' + this.productline.id + '/products/associate', {
                    product: data,
                }).then(data => {
                    if (data.associated === false) {
                        alert('Nepavyko susieti. Reikia perkrauti puslapi!')
                    }
                    this.findProducts();
                });
            },
            disassociateProduct: function (data) {
                axios.post('/api/product-line/' + this.productline.id + '/products/disassociate', {
                    product: data,
                }).then(data => {
                    if (data.disassociated === false) {
                        alert('Nepavyko atsieti. Reikia perkrauti puslapi!')
                    }
                    this.findProducts();
                });
            },
        },
        data() {
            return {
                search: null,
                products: [],
                error: {
                    associate: null,
                    disassociate: null,
                    find: null,
                },
            }
        }
    }
</script>
