<template>
  <h1>Location Details</h1>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
      v-if="!Object.keys(location).length"
      indeterminate
    />
    <LocationCard
      v-else
      :location="location"
      :show="false"
    />
  </v-container>
</template>

<script setup>

import LocationCard from "../components/LocationCard.vue"
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const location = ref([])

onMounted( async ()=> {
  const route = useRoute();
  const id = route.params.id;
  const locationResponse = await getQuery(`locations/${id}`);

  location.value = await locationResponse.json()

})

</script>

<style scoped>

</style>