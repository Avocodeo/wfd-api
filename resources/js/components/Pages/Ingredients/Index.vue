<template>
    <v-content>
        <v-card>
            <v-card-title>
                Ingredients
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="ingredients"
                    :search="search"
                    :loading="loading"
                    loading-text="Loading Ingredients... Please wait"
            >
            </v-data-table>
        </v-card>
    </v-content>
</template>

<script>
    export default {
        data () {
            return {
                search: '',
                headers: [
                    {
                        text: 'Name',
                        align: 'left',
                        sortable: false,
                        value: 'name',
                    },
                    { text: 'Measurement', value: 'measurement.name' },
                    { text: 'Created At', value: 'created_at' },
                    { text: 'Updated At', value: 'updated_at' }
                ],
                ingredients: [],
                loading: true,
                dialog: false
            }
        },
        created() {
            this.getIngredients();
        },
        methods: {
            getIngredients:function () {
                axios.get('api/ingredients')
                    .then((response) => {
                        this.ingredients = response.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>