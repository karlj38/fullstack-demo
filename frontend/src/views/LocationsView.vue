<template>
  <h1>List of Locations</h1>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
      v-if="!locations.length"
      indeterminate
    />
    <LocationCard
      v-for="location of locations"
      :location="location"
      :show="true"
    />
  </v-container>
</template>

<script setup>

import LocationCard from "../components/LocationCard.vue"
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";

const locations = ref([])

onMounted( async ()=> {
  const locationsResponse = await getQuery('locations')

  locations.value = await locationsResponse.json()

})

</script>

<style scoped>

</style>