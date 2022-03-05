<template>
  <h1>Booking Details</h1>
  <v-progress-linear
    v-if="!Object.keys(booking).length"
    indeterminate
  />
  <template v-else>
    <v-container
      class="d-flex flex-row flex-wrap"
    >
      <BookingCard
        :booking="booking"
        :show="false"
      />
    </v-container>

    <v-container
      class="d-flex flex-row flex-wrap"
    >
      <section class="mx-auto">
        <h2 class="text-center">Course</h2>
        <CourseCard
          :course="booking.course"
          :show="true"
        />
      </section>
      <section class="mx-auto">
        <h2 class="text-center">Location</h2>
        <LocationCard
          :location="booking.location"
          :show="true"
        />
      </section>
      <section class="mx-auto">
        <h2 class="text-center">Trainer</h2>
        <TrainerCard
          :trainer="booking.trainer"
          :show="true"
        />
      </section>
    </v-container>

    <h2>Students</h2>
    <v-container
      class="d-flex flex-row flex-wrap"
    >
      <StudentCard
        v-for="student in booking.students"
        :student="student"
        :show="true"
      />
    </v-container>
  </template>
</template>

<script setup>

import BookingCard from "../components/BookingCard.vue";
import CourseCard from "../components/CourseCard.vue";
import LocationCard from "../components/LocationCard.vue";
import StudentCard from "../components/StudentCard.vue";
import TrainerCard from "../components/TrainerCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const booking = ref([])

onMounted( async ()=> {
  const route = useRoute();
  const id = route.params.id;
  const bookingResponse = await getQuery(`bookings/${id}`);

  booking.value = await bookingResponse.json()

})

</script>

<style scoped>

</style>