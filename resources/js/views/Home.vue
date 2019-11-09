<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex>
        <v-card class="elevation-12 mb-6">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Suppliers</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <strong>
              <h2>This is a list of our top suppliers.</h2>
              <h3>
                <br />1. Tromp-Gleichner
                <br />2. Gerlach-Luettgen
                <br />3. Hagenes Group
              </h3>
            </strong>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" to="/suppliers">Rest of List</v-btn>
          </v-card-actions>
        </v-card>
        <v-card class="elevation-12 mb-6">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Groceries</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <!-- Here well call a script for the whether or not your inventories low -->
            Looks like you have some grocery shopping to do !
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" to="/groceries">List</v-btn>
          </v-card-actions>
        </v-card>

        <v-card class="elevation-12">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Things You Can Make</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <!-- Here well call a script for the meals you can make... or if you cant make any cause your inventories to low -->
            Here is the meals you can make with what you have
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary">Meals</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
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
        { text: "Type", value: "type" },
        { text: "Created At", value: "created_at" },
        { text: "Updated At", value: "updated_at" },
        { text: "Actions", value: "action", sortable: false }
      ],
      suppliers: [],
      editedIndex: -1,
      editedItem: {
        name: "",
        type: ""
      },
      defaultItem: {
        name: "",
        type: ""
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
      return this.editedIndex === -1 ? "New Supplier" : "Edit Supplier";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.getSupplier();
  },
  methods: {
    getSupplier: function() {
      axios
        .get("api/suppliers")
        .then(response => {
          this.suppliers = response.data;
          this.loading = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    editItem(item) {
      this.editedIndex = this.suppliers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.suppliers.indexOf(item);
      if (confirm("Are you sure you want to delete this supplier?")) {
        if (this.suppliers.splice(index, 1)) {
          axios.delete("api/suppliers/" + item.id);
          this.snackbarText = "Supplier deleted";
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
        Object.assign(this.suppliers[this.editedIndex], this.editedItem);
        this.snackbarText = "Supplier updated";
        this.snackbar = true;
        axios
          .patch("api/suppliers/" + this.editedItem.id, {
            name: this.editedItem.name
          })
          .then(function(response) {
            console.log(response);
          });
      } else {
        axios
          .post("api/suppliers", {
            name: this.editedItem.name
          })
          .then(function(response) {
            console.log(response);
          });
        this.suppliers.push({
          name: this.editedItem.name,
          "supplier.name": this.editedItem.supplier.name
        });
        this.snackbar = true;
        this.snackbarText = "Supplier created";
      }
      this.close();
    }
  }
};
</script>


<style lang="scss" scoped>
</style>
