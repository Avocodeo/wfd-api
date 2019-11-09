<template>
  <v-card>
    <v-card-title>
      Notifications
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
      :items="notifications"
      :search="search"
      :loading="loading"
      loading-text="Loading Notifications... Please wait"
    >
      <template v-slot:item.quantity="{ item }">
        <v-chip :color="getColor(item)" dark>{{ item.quantity}}</v-chip>
      </template>
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
        { text: "Notifications", value: "data" },
        { text: "Created At", value: "created_at" },
        { text: "Read At", value: "read_at"},
        { 
          text: "Actions", 
          value: "action", 
          sortable: false }
      ],
      notifications: [],
      ingredients: [],
      editedIndex: -1,
      editedItem: {
        ingredient: "",
        quantity: "",
        low: "",
        high: ""
      },
      defaultItem: {
        ingredient: "",
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
      return this.editedIndex === -1 ? "Clear All" : "Edit Item";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.getNotifications();
  },
  methods: {
    getNotifications: function() {
      axios
        .get("api/notifications")
        .then(response => {
          this.notifications = response.data;
          this.loading = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    editItem(item) {
      this.editedIndex = this.notifications.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.notifications.indexOf(item);
      if (confirm("Are you sure you want to delete this Item?")) {
        if (this.notifications.splice(index, 1)) {
          axios.delete("api/notifications/" + item.id);
          this.snackbarText = "Item deleted";
          this.snackbar = true;
        }
      }
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
        Object.assign(this.notifications[this.editedIndex], this.editedItem);
        this.snackbarText = "Item updated";
        this.snackbar = true;
        axios
          .patch("api/notifications/" + this.editedItem.id, {
            ingredient_id: this.editedItem.ingredient.id,
            quantity: this.editedItem.quantity,
            low: this.editedItem.low,
            high: this.editedItem.high
          })
          .then(function(response) {
            console.log(response);
          });
      } else {
        axios
          .post("api/notifications", {
            ingredient_id: this.editedItem.ingredient.id,
            quantity: this.editedItem.quantity,
            low: this.editedItem.low,
            high: this.editedItem.high
          })
          .then(function(response) {
            console.log(response);
          });
        this.notifications.push({
          "ingredient.name": this.editedItem.ingredient.name,
          quantity: this.editedItem.quantity,
          low: this.editedItem.low,
          high: this.editedItem.high
        });
        this.snackbar = true;
        this.snackbarText = "Item created";
      }
      this.close();
    },
    getColor(inventoryItem) {
      if (inventoryItem.quantity < inventoryItem.low) {
        return "red";
      } else if (inventoryItem.quantity > inventoryItem.high) {
        return "orange";
      } else return "green";
    }
  }
};
</script>
