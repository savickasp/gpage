<template>
    <div>
        <span class="mr-auto ml-auto font-size-1-8rem"><b>Susietos produktų linijos</b></span>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Pavadinimas</th>
                <th>Produktai</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="line in productLines">
                <td>
                    <a :href="line.route.show" class="btn btn-outline-dark">{{ line.name }}</a>
                </td>
                <td>{{ line.products.length }}</td>
                <td>
                    <a :href="line.routes.show" class="btn btn-outline-primary">Peržiūrėti</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'pruduct-line-table',
        props: {
            productLines: {
                type: [Object]
            }
        },
    }
</script>
