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
                <template v-slot:item.action="{ item }">
                    <v-icon
                            small
                            class="mr-2"
                            @click=""
                    >
                        mdi-food-apple
                    </v-icon>
                    <v-icon
                            small
                            @click=""
                    >
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
            <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on }">
                    <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="headline">Create Ingredient</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field label="Dessert name"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field label="Calories"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field label="Fat (g)"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field label="Carbs (g)"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field label="Protein (g)"></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="">Cancel</v-btn>
                        <v-btn color="blue darken-1" text @click="">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
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
                    { text: 'Updated At', value: 'updated_at' },
                    { text: 'Actions', value: 'action', sortable: false },
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