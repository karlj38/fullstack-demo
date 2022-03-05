<template>
  <h3>List of Students</h3>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
    v-if="!students.length"
    indeterminate
    />
    <StudentCard
      v-for="student of students"
      :show="true"
      :student="student"
    />
  </v-container>
</template>

<script setup>

import StudentCard from "../components/StudentCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";

const students = ref([])

onMounted( async ()=> {
  const studentsResponse = await getQuery('students')

  students.value = await studentsResponse.json()

})

</script>

<style scoped>

</style>