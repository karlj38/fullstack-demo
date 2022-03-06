<template>
  <h1>List of Locations</h1>
  <v-row class="align-center">
    <v-col md="2">
      <v-text-field
        v-model="city"
        hide-details
        label="Search by city"
      />
    </v-col>
    <v-col
      class="d-flex justify-center"
      md="2"
    >
      <v-btn @click="getGPS"><v-icon>mdi-crosshairs-gps</v-icon>Get GPS</v-btn>
    </v-col>
    <v-col
      v-if="latitude && longitude"
      md="2"
    >
      <v-slider
        v-model="radius"
        color="blue"
        hide-details
        hint="radius"
        label="Radius"
        max="100"
        min="10"
        prepend-icon="mdi-map-marker-radius"
        step="10"
        thumb-label
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
import {computed, onMounted, ref, watch} from "vue";

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

const getGPS = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(setLatLng);
  }
}

const getLocations = async () => {
  let params = {}

  if (latitude.value && longitude.value && radius.value) {
    params.latitude = latitude.value;
    params.longitude = longitude.value;
    params.radius = radius.value
  }

  const locationsResponse = await getQuery('locations', params)

  locations.value = await locationsResponse.json()
}

const latitude = ref("")

const locations = ref([])

const longitude = ref("")

onMounted(()=> {
  getLocations()
})

const radius = ref(50)

const setLatLng = (position) => {
  latitude.value = position.coords.latitude;
  longitude.value = position.coords.longitude;

  getLocations();
}

watch(()=> radius.value, () => {
  getLocations()
})

</script>

<style>
.v-input__prepend {
  padding-top: 0;
}
</style>