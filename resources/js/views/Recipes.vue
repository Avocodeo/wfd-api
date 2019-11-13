<template>
  <v-card>
    <v-card-title>
      Recipes
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
      :items="recipes"
      :search="search"
      :loading="loading"
      loading-text="Loading Recipes... Please wait"
    >
      <template v-slot:item.action="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
        <v-btn @click="showIngredients(item)" color="warning">View</v-btn>
        <v-btn color="primary" class="ml-4" v-model="editedItem" @click="download(item)">Download</v-btn>
        <v-btn color="primary" class="ml-4" v-model="sendEmail" @click="storeEmail(item)">Email</v-btn>
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
                <v-text-field v-model="editedItem.name" label="Edit Recipe"></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-select
                  v-model="editedItem.category"
                  :items="categories"
                  label="Category"
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
    

    <!-- Recipe Ingredients -->
    <v-dialog v-model="ingredientsDialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">{{editedItem.name}}</span>
        </v-card-title>
        <ul>
          <li class="font-weight-black" style="font-size: 16px;"
              v-for="ingredient in editedItem.ingredients">
            {{ingredient.name}} [{{ingredient.pivot.quantity}}] {{ingredient.measurement.abbreviation}}
          </li>
        </ul>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeOther">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialog2" max-width="700px">
      <template v-slot:activator="{ on }"></template>
      <v-card>
        <v-card-title>
          <span class="headline">Send Email</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field v-model="sendEmail.email" label="Email Address"></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
          <v-btn color="blue darken-1" text @click="email">Send Email</v-btn>
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
      fileName: "",
      search: "",
      headers: [
        {
          text: "Name",
          align: "left",
          sortable: false,
          value: "name"
        },
        { text: "Category", value: "categories.name" },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "action", sortable: false }
      ],
      recipes: [],
      categories: [],
      editedIndex: -1,
      editedItem: {
        name: "",
        category: ""
      },
      sendEmail: {
        name: "",
        email: ""
      },
      defaultItem: {
        name: "",
        category_id: ""
      },
      loading: true,
      dialog: false,
      ingredientsDialog: false,
      dialog2: false,
      snackbar: false,
      snackbarText: "",
      snackbarTimeout: 2000
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Recipe" : "Edit Recipe";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.getRecipes();
    this.getCategories();
  },
  methods: {
    getRecipes: function() {
      axios
        .get("api/recipes")
        .then(response => {
          this.recipes = response.data;
          this.loading = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getCategories: function() {
      axios
        .get("api/categories")
        .then(response => {
          this.categories = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    editItem(item) {
      this.editedIndex = this.recipes.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    storeEmail(item) {
      this.editedIndex = this.recipes.indexOf(item);
      this.sendEmail = Object.assign({}, item);
      this.dialog2 = true;
    },
    deleteItem(item) {
      const index = this.recipes.indexOf(item);
      confirm("Are you sure you want to delete this recipe?") &&
        this.recipes.splice(index, 1);
      axios.delete("api/recipes/" + item.id);
      this.snackbarText = "Recipe deleted";
      this.snackbar = true;
    },

    close() {
      this.dialog = false;
      this.dialog2 = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    closeOther() {
      this.ingredientsDialog = false;
    },
    download(item) {
      const blob = new Blob(["Recipe Name: ", item.name], {
          type: "text/plain"
        }),
        anchor = document.createElement("a");
      anchor.download = _.kebabCase(item.name) + ".txt";
      anchor.href = (window.webkitURL || window.URL).createObjectURL(blob);
      anchor.dataset.downloadurl = [
        "text/plain",
        anchor.download,
        anchor.href
      ].join(":");
      anchor.click();
      this.snackbar = true;
      this.snackbarText = "Recipe Downloaded";
    },
    email() {
      axios.post("/api/email", {
        email: this.sendEmail.email,
        recipe: this.sendEmail.name
      });

      this.snackbar = true;
      this.snackbarText = "Email Submitted";

      this.close();
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.recipes[this.editedIndex], this.editedItem);
        this.snackbarText = "Recipe updated";
        this.snackbar = true;
        axios
          .patch("api/recipes/" + this.editedItem.id, {
            name: this.editedItem.name,
            category_id: this.editedItem.category.id
          })
          .then(function() {
            axios
              .post("api/notifications", {
                body: "Recipe Updated"
              })
              .then(response => console.log(response));
          })
          .then(function(response) {
            console.log(response);
          });
      } else {
        axios
          .post("api/recipes", {
            name: this.editedItem.name,
            category_id: this.editedItem.category.id
          })
          .then(function() {
            axios
              .post("api/notifications", {
                body: "Recipe Added"
              })
              .then(response => console.log(response));
          })
          .then(function(response) {
            console.log(response);
          });
        this.recipes.push({
          name: this.editedItem.name,
          "category.name": this.editedItem.category.name
        });
        this.snackbar = true;
        this.snackbarText = "Recipe created";
      }
      this.close();
    },
    showIngredients(item) {
      this.editedIndex = this.recipes.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.ingredientsDialog = true;
    }
  }
};
</script>