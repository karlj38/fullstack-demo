<template>
  <h3>List of Courses</h3>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <CourseCard
      v-for="course of courses"
      :course="course"
    />
  </v-container>
</template>

<script setup>

import CourseCard from "../components/CourseCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";

const courses = ref([])

onMounted( async ()=> {
  const coursesResponse = await getQuery('courses')

  courses.value = await coursesResponse.json()

})

</script>

<style scoped>

</style>