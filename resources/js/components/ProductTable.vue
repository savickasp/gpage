<template>
    <div>
        <span class="mr-auto ml-auto font-size-1-8rem"><b>Susieti produktai</b></span>
        <table class="table table-hover ">
            <thead>
            <tr>
                <th>Pavadinimas</th>
                <th>Modifikacijos</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody class="">
            <tr v-for="product in products">
                <td>
                    <a :href='product.route.show' class="btn btn-outline-dark">{{ product.show }}</a>
                </td>
                <td>{{ product.modifications.length }}</td>
                <td>
                    <a :href='product.route.show' class="btn btn-outline-primary">Peržiūrėti</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'product-table',
        props: {
            products: {
                type: [Object]
            }
        },
    }
</script>
