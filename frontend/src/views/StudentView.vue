<template>
  <h1>Student Details</h1>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
      v-if="!Object.keys(student).length"
      indeterminate
    />
    <StudentCard
      v-else
      :student="student"
      :show="false"
    />
  </v-container>

  <template v-if="student && student.bookings && student.bookings.length">
    <h2>Student's Bookings</h2>
    <v-container
      class="d-flex flex-row flex-wrap"
    >
      <BookingCard
        v-for="booking in student.bookings"
        :booking="booking"
        :show="true"
      />
    </v-container>
  </template>
</template>

<script setup>

import StudentCard from "../components/StudentCard.vue";
import BookingCard from "../components/BookingCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const student = ref([])

onMounted( async ()=> {
  const route = useRoute();
  const id = route.params.id;
  const studentResponse = await getQuery(`students/${id}`);

  student.value = await studentResponse.json()

})

</script>

<style scoped>

</style>