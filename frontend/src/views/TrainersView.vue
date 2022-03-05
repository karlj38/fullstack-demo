<template>
  <h1>List of Trainers</h1>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
      v-if="!trainers.length"
      indeterminate
    />
    <TrainerCard
      v-for="trainer of trainers"
      :trainer="trainer"
      :show="true"
    />
  </v-container>
</template>

<script setup>

import TrainerCard from "../components/TrainerCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";

const trainers = ref([])

onMounted( async ()=> {
  const trainersResponse = await getQuery('trainers')

  trainers.value = await trainersResponse.json()

})

</script>

<style scoped>

</style>