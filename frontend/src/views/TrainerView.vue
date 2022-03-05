<template>
  <h1>Trainer Details</h1>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
      v-if="!trainer"
      indeterminate
    />
    <TrainerCard
      :trainer="trainer"
      :show="false"
    />
  </v-container>

  <template v-if="trainer && trainer.bookings && trainer.bookings.length">
    <h2>Trainer's Bookings</h2>
    <v-container
      class="d-flex flex-row flex-wrap"
    >
      <BookingCard
        v-for="booking in trainer.bookings"
        :booking="booking"
        :show="true"
      />
    </v-container>
  </template>
</template>

<script setup>

import TrainerCard from "../components/TrainerCard.vue";
import BookingCard from "../components/BookingCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const trainer = ref([])

onMounted( async ()=> {
  const route = useRoute();
  const id = route.params.id;
  const trainerResponse = await getQuery(`trainers/${id}`);

  trainer.value = await trainerResponse.json()

})

</script>

<style scoped>

</style>