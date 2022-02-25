<template>
  <v-btn @click="goToAddBooking">Add New Booking</v-btn>
  <h3 class="mt-6">Upcoming Bookings: </h3>
</template>

<script setup lang="ts">
  import router from "@/router";

  function goToAddBooking() {
    router.push('/bookings/new')
  }
</script>

<style scoped>

</style>