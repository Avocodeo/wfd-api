<template>
  <v-card>
    <v-card-title>
      Measurements
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
      :items="measurements"
      :search="search"
      :loading="loading"
      loading-text="Loading Measurements... Please wait"
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
                <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field v-model="editedItem.abbreviation" label="Abbreviation"></v-text-field>
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
        { text: "Abbreviation", value: "abbreviation" },
        { text: "Type", value: "type.name" },
        { text: "Created at", value: "created_at" },
        { text: "Updated at", value: "updated_at" },
        { text: "Actions", value: "action", sortable: false }
      ],
      measurements: [],
      types: [],
      editedIndex: -1,
      editedItem: {
        name: "",
        abbreviation: ""
      },
      defaultItem: {
        name: ""
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
      return this.editedIndex === -1 ? "New Measurement" : "Edit Measurement";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.getMeasurements();
    this.getTypes();
  },
  methods: {
    getMeasurements: function() {
      axios
        .get("api/measurements")
        .then(response => {
          this.loading = false;
          this.measurements = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getTypes: function() {
      axios
        .get("api/measurement_types")
        .then(response => {
          this.types = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    editItem(item) {
      this.editedIndex = this.measurements.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.measurements.indexOf(item);
      if (confirm("Are you sure you want to delete this measurement")) {
        if (this.measurements.splice(index, 1)) {
          axios.delete("api/measurements/" + item.id);
          this.snackbarText = "Measurement deleted";
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
        Object.assign(this.measurements[this.editedIndex], this.editedItem);
        this.snackbarText = "Measurement updated";
        this.snackbar = true;
        axios
          .patch("api/measurements/" + this.editedItem.id, {
            name: this.editedItem.name,
            abbreviation: this.editedItem.abbreviation,
            type_id: this.editedItem.type.id
          })
          .then(function(response) {
            console.log(response);
          });
      } else {
        axios
          .post("api/measurements", {
            name: this.editedItem.name,
            abbreviation: this.editedItem.abbreviation,
            type_id: this.editedItem.type.id
          })
          .then(function(response) {
            console.log(response);
          });
        this.measurements.push({
          name: this.editedItem.name,
          abbreviation: this.editedItem.abbreviation,
          "type.name": this.editedItem.type.name
        });
        this.snackbar = true;
        this.snackbarText = "Measurement created";
      }
      this.close();
    }
  }
};
</script>
