<template>
    <table class="table">
        <thead>
        <tr>

            <th>Pavadinimas</th>
            <th>Gamintojas</th>
            <th>Veiksmai</th>
            <th>
                <input v-model="search">
                <button @click="findProductLines" class="btn btn-primary">ieškoti</button>
                <button @click="findAssociated" class="btn btn-primary">ieškori susietų</button>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="productLine in productLines">
            <td>{{ productLine.name }}</td>
            <td>
                <template v-if="productLine.manufacturer">{{ productLine.manufacturer.name }}</template>
            </td>
            <td colspan="2">
                <button v-if="!productLine.manufacturer"
                        @click="associateProductLine(productLine.id)"
                        class="btn btn-primary">susieti
                </button>
                <button v-else-if="productLine.manufacturer.id === manufacturer.id"
                        @click="disassociateProductLine(productLine.id)"
                        class="btn btn-danger">Atsieti
                </button>
                <span v-else>Prosukto linija susieta su kitu gamintoju.</span>
            </td>
        </tr>
        <tr v-show="!productLines.length">
            <td colspan="3">Nerasta produktu liniju</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: 'manufacturer-hasmany-product-lines',
        props: {
            manufacturer: {
                type: [Object]
            }
        },
        created() {
            this.findAssociated();
        },
        methods: {
            findProductLines: function (data) {
                axios.post('/api/manufacturer/' + this.manufacturer.id + '/product-lines/filter', data).then(data => {
                    this.productLines = data.data;
                });
            },
            findAssociated: function () {
                this.findProductLines({ id: this.manufacturer.id });
            },
            associateProductLine: function (data) {
                axios.post('/api/manufacturer/' + this.manufacturer.id + '/product-lines/associate', {
                    productLine: data,
                }).then(data => {
                    if (data.associated === false) {
                        alert('Nepavyko susieti. Reikia perkrauti puslapi!')
                    }
                    this.findProductLines();
                });
            },
            disassociateProductLine: function (data) {
                axios.post('/api/manufacturer/' + this.manufacturer.id + '/product-lines/disassociate', {
                    productLine: data,
                }).then(data => {
                    if (data.disassociated === false) {
                        alert('Nepavyko atsieti. Reikia perkrauti puslapi!')
                    }
                    this.findProductLines();
                });
            },
        },
        data() {
            return {
                search: null,
                productLines: [],
                error: {
                    associate: null,
                    disassociate: null,
                    find: null,
                },
            }
        }
    }
</script>
