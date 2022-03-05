<template>
  <h3>List of Students</h3>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
    v-if="!student"
    indeterminate
    />
    <StudentCard
      :student="student"
      :show="false"
    />
  </v-container>

  <h3>Student's Bookings</h3>
    <v-container
      v-if="student && student.bookings && student.bookings.length"
      class="d-flex flex-row flex-wrap"
    >
      <BookingCard
        v-for="booking in student.bookings"
        :booking="booking"
      />
    </v-container>
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