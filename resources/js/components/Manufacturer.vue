<template>
    <div>
        <div class="w-100 mb-4 mt-2">
            <span class="font-size-1rem"><b>Veiksmai:</b></span>
            <a @click=""></a>
        </div>
        <product-line-table :productLines="relatedProductLines"></product-line-table>
        <product-table :products="relatedProducts"></product-table>
    </div>
</template>

<script>
    export default {
        name: 'manufacturer',
        props: {
            manufacturer: {
                type: [Object]
            }
        },
        created() {
            this.getRelatedProductLines(this.manufacturer);
            this.getRelatedProducts(this.manufacturer);
        },
        methods: {
            getRelatedProductLines: function (data) {
                axios.get('/api/manufacturer/' + data.id + '/productline')
                    .then(({data}) => {
                        this.relatedProductLines = data.productLines;
                    })
            },
            getRelatedProducts: function (data) {
                axios.get('/api/manufacturer/' + data.id + '/product')
                    .then(({data}) => {
                        this.relatedProducts = data.productLines;
                    })
            },
            assignRelation: function (data) {
                axios.post('/api/relation/', data)
                    .then(({data}) => {
                        if (data.error == null) {
                            this.relatedAddress.push(data.error.productLine);
                        } else {
                            alert(data.error);
                        }
                    })
            }
        },
        data() {
            return {
                relatedProductLines: [],
                relatedProducts: [],
                searchResult: [],
            }
        }
    }
</script>
