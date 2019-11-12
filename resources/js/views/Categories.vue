<template>
  <v-card>
    <v-card-title>
      Categories
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
      :items="categories"
      :search="search"
      :loading="loading"
      loading-text="Loading Categories... Please wait"
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
                <v-text-field v-model="editedItem.name" label="Category Name"></v-text-field>
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
          text: "id",
          align: "left",
          sortable: false,
          value: "id"
        },
        { text: "Name", value: "name" },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "action", sortable: false }
      ],
      categories: [],
      editedIndex: -1,
      editedItem: {
        name: ""
      },
      defaultItem: {
        name: "",
        category_id: ""
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
      return this.editedIndex === -1 ? "New Category" : "Edit Category";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.getCategory();
  },
  methods: {
    getCategory: function() {
      axios
        .get("api/categories")
        .then(response => {
          this.categories = response.data;
          this.loading = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    editItem(item) {
      this.editedIndex = this.categories.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.categories.indexOf(item);
      if (confirm("Are you sure you want to delete this category?")) {
        if (this.categories.splice(index, 1)) {
          axios.delete("api/categories/" + item.id);
          this.snackbarText = "Category deleted";
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
        Object.assign(this.categories[this.editedIndex], this.editedItem);
        this.snackbarText = "Category updated";
        this.snackbar = true;
        axios
          .patch("api/categories/" + this.editedItem.id, {
            name: this.editedItem.name
          })
          .then(function() {
            axios
              .post("api/notifications", {
                body: "Category Updated"
              })
              .then(response => console.log(response));
          })
          .then(function(response) {
            console.log(response);
          });
      } else {
        axios
          .post("api/categories", {
            name: this.editedItem.name
          })
          .then(function(response) {
            console.log(response);
          });
        this.categories.push({
          name: this.editedItem.name
        });
        this.snackbar = true;
        this.snackbarText = "Category created";
      }
      this.close();
    }
  }
};
</script>
