<template>
    <v-card>
        <v-card-title>
            Grocery List
        </v-card-title>
        <v-data-table
            v-model="selected"
            :headers="headers"
            :items="groceries"
            item-key="name"
            show-select
            :loading="loading"
            disable-pagination
            hide-default-footer
            :no-data-text="noDataText"
        >
            <template v-slot:item.action="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
            </template>
        </v-data-table>
        <v-dialog v-model="dialog" max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-text-field v-model="editedItem.amount" label="amount"></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="updateItem">Update</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <button class="btn-primary fixed-button py-4 px-5 rounded-pill" @click="save">Finish Shopping</button>
    </v-card>
</template>

<script>
    export default {
        data() {
            return {
                headers: [
                    { text: "Name", value: "name" },
                    { text: "Amount", value: "amount" },
                    { text: "Actions", value: "action", sortable: false }
                ],
                groceries: [],
                editedIndex: -1,
                editedItem: {
                    name: "",
                    amount: "",
                },
                defaultItem: {
                    name: "",
                    amount: "",
                },
                dialog: false,
                loading: true,
                selected: [],
                noDataText: "Your all stocked up no need to buy new groceries !"
            };
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? "New Item" : "Edit Item";
            }
        },
        watch: {
            dialog(val) {
                val || this.close();
            }
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
            save: function() {
                axios.post("api/groceries", {
                    purchasedItems : this.selected
                })
                    .then(response => {
                        console.log(response);
                        window.location = "/inventories";
                    });
            },
            close() {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300);
            },
            editItem(item) {
                this.editedIndex = this.groceries.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
            },
            updateItem() {
                if (this.editedIndex > -1) {
                    Object.assign(this.groceries[this.editedIndex], this.editedItem);
                }
                this.close();
            }
        }
    };
</script>
<style>
    .fixed-button {
        position: fixed;
        bottom: 0px;
        right: 0px;
    }
</style>
