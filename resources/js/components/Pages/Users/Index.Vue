<template>
  <v-content>
    <v-card>
      <v-card-title>
        Users
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
        :items="users"
        :search="search"
        :loading="loading"
        loading-text="Loading Users... Please wait"
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
                  <v-text-field v-model="editedItem.name" label="User Name"></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-select
                    v-model="editedItem.measurement"
                    :items="users"
                    label="User"
                    item-text="name"
                    item-value="id"
                    return-object
                    prepend-icon="mdi-scale-balance"
                  ></v-select>
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
  </v-content>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      headers: [
        {
          text: "Name",
          align: "left",
          sortable: false,
          value: "name"
        },
        { text: "User", value: "user.name" },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "action", sortable: false }
      ],
      users: [
        {
          text: "TESTTESTTEST",
          value: 1
        }
      ],
      editedIndex: -1,
      editedItem: {
        name: "",
        measurement: ""
      },
      defaultItem: {
        name: "",
        measurement_id: ""
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
      return this.editedIndex === -1 ? "New User" : "Edit User";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.getIngredients();
    this.getMeasurements();
  },
  methods: {
    getIngredients: function() {
      axios
        .get("api/users")
        .then(response => {
          this.users = response.data;
          this.loading = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    getMeasurements: function() {
      axios
        .get("api/users")
        .then(response => {
          this.users = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    editItem(item) {
      this.editedIndex = this.ingredients.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.ingredients.indexOf(item);
      confirm("Are you sure you want to delete this user?") &&
        this.ingredients.splice(index, 1);
      axios.delete("api/users/" + item.id);
      this.snackbarText = "User deleted";
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
        Object.assign(this.users[this.editedIndex], this.editedItem);
        this.snackbarText = "User updated";
        this.snackbar = true;
        axios
          .patch("api/users/" + this.editedItem.id, {
            name: this.editedItem.name,
            user_id: this.editedItem.measurement.id
          })
          .then(function(response) {
            console.log(response);
          });
      } else {
        axios
          .post("api/users", {
            name: this.editedItem.name,
            user_id: this.editedItem.measurement.id
          })
          .then(function(response) {
            console.log(response);
          });
        this.ingredients.push({
          name: this.editedItem.name,
          "users.name": this.editedItem.measurement.name
        });
        this.snackbar = true;
        this.snackbarText = "User created";
      }
      this.close();
    }
  }
};
</script>
