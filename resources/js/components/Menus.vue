<template>
  <div>
    <v-navigation-drawer class="accent-4" :mini-variant.sync="mini" app permanent>
      <v-list dense>
        <v-list-item @click href="/home" class="text-decoration-none">
          <v-list-item-action>
            <v-icon color="blue" size="48">mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click href="/categories" class="text-decoration-none">
          <v-list-item-action>
            <v-icon color="black" size="48">mdi-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Categories</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click href="/ingredients" class="text-decoration-none">
          <v-list-item-action>
            <v-icon color="red" size="48">mdi-food-apple</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Ingredients</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click href="/measurements" class="text-decoration-none">
          <v-list-item-action>
            <v-icon color="grey" size="48">mdi-scale-balance</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Measurements</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click href="/users" class="text-decoration-none">
          <v-list-item-action>
            <v-icon color="green" size="48">mdi-account-circle-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Users</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar app color="indigo" dark>
      <v-app-bar-nav-icon @click.stop="mini = !mini"></v-app-bar-nav-icon>

      <v-toolbar-title>Whats For Dinner</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-avatar color="teal" size="48">
        <span class="white--text headline">UR</span>
      </v-avatar>

      <v-btn icon>
        <v-icon href="/logout">mdi-login</v-icon>
      </v-btn>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  data: () => ({
    // drawer: null,
    mini: true
  })
};
</script>
