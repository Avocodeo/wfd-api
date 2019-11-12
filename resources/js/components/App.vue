<template>
  <div>
    <v-app class="inspire">
      <v-navigation-drawer class="accent-4" :mini-variant.sync="mini" app permanent>
        <v-list dense>
          <v-list-item to="/home" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="blue" size="48">mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Home</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="/categories" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="yellow" size="48">mdi-view-dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Categories</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="ingredients" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="red" size="48">mdi-food-apple</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Ingredients</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="/inventories" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="purple" size="48">mdi-clipboard-text</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Inventory</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="/groceries" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="red" size="48">mdi-format-list-bulleted</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Groceries</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="measurements" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="grey" size="48">mdi-scale-balance</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Measurements</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="/recipes" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="black" size="48">mdi-book-open-page-variant</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Recipes</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="/suppliers" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="orange" size="48">mdi-cube-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Suppliers</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="/users" class="text-decoration-none">
            <v-list-item-action>
              <v-icon color="green" size="48">mdi-account-circle-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Users</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-app-bar app color="blue" dark>
        <v-app-bar-nav-icon @click.stop="mini = !mini"></v-app-bar-nav-icon>

        <v-toolbar-title>Whats For Dinner</v-toolbar-title>

        <v-spacer></v-spacer>

        <div>
          <v-btn
            @click="displayNotificationsToggle = !displayNotificationsToggle"
            class="text-decoration-none bg-primary"
          >
            <v-badge color="red" overlap>
              <template v-slot:badge>
                <span v-if="notifications.length > 0">{{ notifications.length }}</span>
              </template>
              <v-icon>mdi-bell</v-icon>
            </v-badge>
          </v-btn>
          <div
            class="position-absolute v-sheet v-card bg-light"
            style="width: 260px; height: 280px; color: black;"
            v-if="displayNotificationsToggle"
          >
            <h3 class="border-bottom py-2 text-center">Notifications</h3>
            <div>
              <div
                class="border-bottom notification-item m-2"
                style="font-size: 22px; cursor: pointer; margin:20px;"
                v-for="notification in notifications"
                v-bind:key="notification.id"
                @click="removeNotification(notification)"
              >{{ notification.message }}</div>
            </div>
          </div>
        </div>

        <v-btn text to="/account" class="text-decoration-none">
          <v-icon>mdi-account-circle</v-icon>
          <span class="ml-3" v-if="$vuetify.breakpoint.mdAndUp">My Account</span>
        </v-btn>

        <v-btn outlined color @click="logout">
          <v-icon>mdi-logout</v-icon>Sign Out
        </v-btn>
      </v-app-bar>

      <v-content>
        <router-view></router-view>

        <v-snackbar
          v-model="snackbar.enabled"
          :color="snackbar.color"
          :bottom="true"
          :timeout="snackbar.timeout"
        >
          {{ snackbar.message }}
          <v-btn color="white" text @click="snackbar.enabled = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-snackbar>
      </v-content>

      <div class="footer caption text-center mt-5 mb-3">{{ title }} &copy; 2019</div>
    </v-app>
  </div>
</template>

<script>
import Event from "./../events";

export default {
  name: "App",
  props: ["title"],
  data() {
    return {
      snackbar: {
        enabled: false,
        message: "",
        timeout: 5000,
        color: ""
      },
      displayNotificationsToggle: false,
      notifications: [],
      mini: true
    };
  },
  created() {
    window.Echo.channel("inventory").listen("InventoryUpdate", e => {
        this.notifications.push({ message: e.message });
      });
      
    window.Echo.channel("users").listen("NewUser", e => { 
        this.notifications.push({ message: e.message });
      });

    Event.$on("success", message => {
      this.snackbar.message = message;
      this.snackbar.color = "success";
      this.snackbar.enabled = true;
    });
    Event.$on("warning", message => {
      this.snackbar.message = message;
      this.snackbar.color = "warning";
      this.snackbar.enabled = true;
    });
    Event.$on("error", message => {
      this.snackbar.message = message;
      this.snackbar.color = "error";
      this.snackbar.enabled = true;
    });
  },
  methods: {
    logout() {
      axios.get("/api/logout").then(function() {
        location.reload();
      });
    },
    removeNotification(notification) {
      const index = this.notifications.indexOf(notification);
      this.notifications.splice(index, 1);
    },
   
  }
};
</script>
<style scoped>
.notification-item:hover {
  background-color: lightskyblue;
}
</style>
