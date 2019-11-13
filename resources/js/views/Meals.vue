<template>
    <v-card>
        <v-card-title>Available Meals</v-card-title>
        <v-data-table
                :headers="headers"
                :items="meals"
                item-key="name"
                :loading="loading"
                disable-pagination
                hide-default-footer
                :no-data-text="noDataText"
                group-by="name"
        >
        </v-data-table>
    </v-card>
</template>

<script>
    export default {
        data() {
            return {
                headers: [
                    { text: "Name", value: "name" },
                    { text: "Ingredient Name", value:"ingredient_name"},
                    { text: "Enough Iventory", value: "enough"}
                ],
                meals: [],
                loading: true,
                noDataText: "You need to go grocery shopping no meals can be made !"
            };
        },
        created() {
            this.getMeals();
        },
        methods: {
            getMeals: function() {
                axios.get("api/meals")
                    .then(response => {
                        this.meals = response.data;
                        this.loading = false;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
        },
        enough: function(item) {
            if(item) {
                return "Yes"
            } else return "No"
        }
    };
</script>
