<template>
  <v-btn @click="goToAddBooking">Add New Booking</v-btn>
  <h1>List of Bookings</h1>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
    v-if="!bookings.length"
    indeterminate
    />
    <BookingCard

      v-for="booking of bookings"
      :booking="booking"
    />
  </v-container>
</template>

<script setup>

import BookingCard from "../components/BookingCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";

const bookings = ref([])

onMounted( async ()=> {
  const bookingsResponse = await getQuery('bookings')

  bookings.value = await bookingsResponse.json()

})

</script>

<style scoped>

</style>