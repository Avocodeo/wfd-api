<template>
  <v-card>
    <v-card-title>
      Inventory
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
      :items="inventories"
      :search="search"
      :loading="loading"
      loading-text="Loading Inventory... Please wait"
    >
      <template v-slot:item.action="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on }">
        <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">{{ formTitle }}</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field v-model="editedItem.name" label="Item Name"></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
          <v-btn color="blue darken-1" text @click="save">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar v-model="snackbar" :timeout="snackbarTimeout">
      {{ snackbarText }}
      <v-btn color="blue" text @click="snackbar = false">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      headers: [
        {
          text: "Id",
          align: "left",
          sortable: false,
          value: "id"
        },
        { text: "Quantity", value: "quantity" },
        { text: "Low", value: "low" },
        { text: "High", value: "high" },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "action", sortable: false }
      ],
      editedIndex: -1,
      editedItem: {
        quantity: "",
        low: "",
        high: ""
      },
      defaultItem: {
        quantity: "",
        low: "",
        high: ""
      },
      loading: true,
      dialog: false,
      snackbar: false,
      snackbarText: "",
      snackbarTimeout: 2000
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
    this.getInventory();
  },
  methods: {
    getInventory: function() {
      axios
        .get("api/inventories")
        .then(response => {
          this.ingredients = response.data;
          this.loading = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    editItem(item) {
      this.editedIndex = this.inventories.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.inventories.indexOf(item);
      confirm("Are you sure you want to delete this Item?") &&
        this.inventories.splice(index, 1);
      axios.delete("api/inventories/" + item.id);
      this.snackbarText = "Item deleted";
      this.snackbar = true;
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.ingredients[this.editedIndex], this.editedItem);
        this.snackbarText = "Item updated";
        this.snackbar = true;
        axios
          .patch("api/inventories/" + this.editedItem.id, {
            id: this.editedItem.id,
            quantity: this.editedItem.inventory.quantity,
            low: this.editedItem.low,
            high: this.editedItem.high
          })
          .then(function(response) {
            console.log(response);
          });
      } else {
        axios
          .post("api/inventories", {
            id: this.editedItem.id,
            quantity: this.editedItem.inventory.quantity,
            low: this.editedItem.low,
            high: this.editedItem.high
          })
          .then(function(response) {
            console.log(response);
          });
        this.ingredients.push({
          id: this.editedItem.id,
          quantity: this.editedItem.inventory.quantity,
          low: this.editedItem.low,
          high: this.editedItem.high
        });
        this.snackbar = true;
        this.snackbarText = "Item created";
      }
      this.close();
    }
  }
};
</script>
