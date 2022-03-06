<template>
  <h1>List of Trainers</h1>
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
      v-if="!trainers.length"
      indeterminate
    />
    <TrainerCard
      v-for="trainer of filteredTrainers"
      :trainer="trainer"
      :show="true"
    />
  </v-container>
</template>

<script setup>

import TrainerCard from "../components/TrainerCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {computed, onMounted, ref} from "vue";

const city = ref("")

const filteredTrainers = computed(() => {
  let output = [...trainers.value];

  if (trainers.value.length && city.value) {
    output = output.filter(trainer => {
      return trainer.city.toLowerCase().startsWith(city.value.toLowerCase());
    });
  }

  return output
})

const trainers = ref([])

onMounted( async ()=> {
  const trainersResponse = await getQuery('trainers')

  trainers.value = await trainersResponse.json()

})

</script>

<style scoped>

</style>