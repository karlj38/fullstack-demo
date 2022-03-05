<template>
  <v-app>
    <v-navigation-drawer
        app
        :permanent="true"
        :expand-on-hover="true"
    >
      <v-list class="" >
        <v-list-item class="text-grey-darken-1">
          <v-icon class="mr-2" icon="mdi-book" />
          <router-link to="/Bookings">
            Bookings
          </router-link>
        </v-list-item>
        <v-list-item class="text-grey-darken-1">
          <v-icon class="mr-2" icon="mdi-library" />
          <router-link to="/courses">
            Courses
          </router-link>
        </v-list-item>
        <v-list-item class="text-grey-darken-1">
          <v-icon class="mr-2"  icon="mdi-map-marker" />
          <router-link to="/locations">
            Locations
          </router-link>
        </v-list-item>
        <v-list-item class="text-grey-darken-1">
          <v-icon class="mr-2" icon="mdi-account-supervisor" />
          <router-link to="/students">
            Students
          </router-link>
        </v-list-item>
        <v-list-item class="text-grey-darken-1">
          <v-icon class="mr-2" icon="mdi-account-supervisor" />
          <router-link to="/trainers">
            Trainers
          </router-link>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-main>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  components: {

  },

  data: () => ({
    //
  }),
}
</script>

<style>
 a {
   text-decoration: none;
 }
</style>