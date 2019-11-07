<template>
  <v-container fluid fill-height>
    <v-layout
      align-center
      justify-center
    >
      <v-flex>

        <v-card class="elevation-12 mb-6">
          <v-toolbar
                  color="primary"
                  dark
                  flat
          >
            <v-toolbar-title>Groceries</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <!-- Here well call a script for the whether or not your inventories low -->
            Looks like you have some grocery shopping to do !
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary">List</v-btn>
          </v-card-actions>
        </v-card>

        <v-card class="elevation-12">
          <v-toolbar
                  color="primary"
                  dark
                  flat
          >
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
  name: "Home"
};
</script>

<style lang="scss" scoped>
</style>
