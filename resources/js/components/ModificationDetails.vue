<template>
    <table class="table table-hover">
        <tbody>
        <tr>
            <th>Pavadinimas</th>
            <td>{{modification.name}}</td>
        </tr>
        <tr>
            <th>Kaina</th>
            <td>{{modification.price}}</td>
        </tr>
        <tr>
            <th>Mato vienetas</th>
            <td>
                <template v-if="unitValueSet">
                    {{modification.unitvalue.name}}
                    <button @click="removeUnitValue" class="btn btn btn-danger">Atsieti mato vieneta</button>
                </template>
                <template v-else>
                    <select v-model="selectedUnitValue">
                        <option v-for="unitValue in unitValues" :value="unitValue.id">{{unitValue.name}}</option>
                    </select>
                    <button @click="associateUnitValue" class="btn btn-primary">Susieti</button>
                </template>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: 'modification-unit-value',
        props: {
            modification: [Object],
            product: [Object],
        },
        created() {
            this.isSet();
        },
        methods: {
            isSet: function () {
                if (this.modification.unitvalue) {
                    this.unitValueSet = true;
                } else {
                    this.unitValueSet = false;
                    this.getAllUnitValues();
                }
            },
            removeUnitValue: function () {
                axios.get('/api/modification/' + this.modification.id + '/unitvalue/' + this.modification.unitvalue.id + '/disassociate').then(data => {
                        this.modification = data.data;
                        this.isSet();
                    }
                )
            },
            getAllUnitValues: function () {
                axios.get('/api/unitvalues/').then(data => {
                    this.unitValues = data.data;
                })
            },
            associateUnitValue: function () {
                axios.get('/api/modification/' + this.modification.id + '/unitvalue/' + this.selectedUnitValue + '/associate').then(data => {
                        this.modification = data.data;
                        this.isSet();
                    }
                )
            }
        },
        data() {
            return {
                unitValues: null,
                unitValueSet: false,
                selectedUnitValue: null,
            }
        }
    }
</script>
