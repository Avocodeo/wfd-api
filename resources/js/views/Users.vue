<template>
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
                <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
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
          text: "Name",
          align: "left",
          value: "name"
        },
        { text: "email", value: "email" },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "action", sortable: false }
      ],
      users: [],
      editedIndex: -1,
      editedItem: {
        name: "",
        email: ""
      },
      defaultItem: {
        name: "",
        email: ""
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
    this.getUsers();
  },
  methods: {
    getUsers: function() {
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

    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.users.indexOf(item);
      let deleteUser = confirm("Are you sure you want to delete this user?");
      if (deleteUser) {
        this.users.splice(index, 1);
        axios.delete("api/users/" + item.id);
        this.snackbarText = "User deleted";
        this.snackbar = true;
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
        Object.assign(this.users[this.editedIndex], this.editedItem);
        this.snackbarText = "User updated";
        this.snackbar = true;
        axios
          .patch("api/users/" + this.editedItem.id, {
            name: this.editedItem.name,
            email: this.editedItem.email
          })
          .then(function() {
            axios
              .post("api/notifications", {
                body: "User Updated"
              })
              .then(response => console.log(response));
          })
          .then(function(response) {
            console.log(response);
          });
      } else {
        this.users.push({
          name: this.editedItem.name,
          email: this.editedItem.email
        });
        this.snackbar = true;
        this.snackbarText = "User created";
        axios
          .post("api/users", {
            name: this.editedItem.name,
            email: this.editedItem.email
          })
          .then(function(response) {
            console.log(response);
          });
      }
      this.close();
    }
  }
};
</script>
