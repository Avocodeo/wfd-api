<template>
    <v-card>
        <v-card-title>
            Grocery List
        </v-card-title>
        <v-data-table
            v-model="selected"
            :headers="headers"
            :items="groceries"
            :single-select="singleSelect"
            item-key="name"
            show-select
            class="elevation-1"
        >
            <template v-slot:top>
                <v-switch v-model="singleSelect" label="Single select" class="pa-3"></v-switch>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
    export default {
        data() {
            return {
                headers: [
                    { text: "Name", value: "name" },
                ],
                groceries: [],
                loading: true,
            };
        },
        computed: {
        },
        watch: {
        },
        created() {
            this.getGroceries();
        },
        methods: {
            getGroceries: function() {
                axios.get("api/groceries")
                    .then(response => {
                        this.groceries = response.data;
                        this.loading = false;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
        }
    };
</script>
