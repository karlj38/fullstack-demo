<template>
  <h1>List of Locations</h1>
  <v-row>
    <v-col md="2">
      <v-text-field
        v-model="city"
        label="Search by city"
      />
    </v-col>
  </v-row>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
      v-if="!locations.length"
      indeterminate
    />
    <LocationCard
      v-for="location of filteredLocations"
      :key="location.id"
      :location="location"
      :show="true"
    />
  </v-container>
</template>

<script setup>

import LocationCard from "../components/LocationCard.vue"
import {getQuery} from "../utils/fetchbackend";
import {computed, onMounted, ref} from "vue";

const city = ref("");

const filteredLocations = computed(() => {
  let output = [...locations.value];

  if (locations.value.length && city.value) {
    output = output.filter(location => {
      return location.city.toLowerCase().startsWith(city.value.toLowerCase());
    });
  }

  return output
})
const locations = ref([])

onMounted( async ()=> {
  const locationsResponse = await getQuery('locations')

  locations.value = await locationsResponse.json()

})

</script>

<style scoped>

</style>