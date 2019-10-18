<template>
    <div>
        <v-navigation-drawer
            v-model="drawer"
            app
        >
            <v-list dense>
                <v-list-item @click="" href="/home" class="text-decoration-none">
                    <v-list-item-action>
                        <v-icon color="blue">mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item @click="" href="/ingredients" class="text-decoration-none">
                    <v-list-item-action>
                        <v-icon color="red">mdi-food-apple</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Ingredients</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar
            app
            color="indigo"
            dark
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

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
            drawer: null,
        }),
    }
</script>
