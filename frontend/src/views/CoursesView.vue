<template>
  <h1>List of Courses</h1>
  <v-row>
    <v-col md="2">
      <v-select
        v-model="topic"
        :items="topics"
        label="Select topic"
      />
    </v-col>
    <v-col md="2">
      <v-select
        v-model="level"
        :items="[1, 2, 3, 4, 5]"
        label="Select level"
      />
    </v-col>
  </v-row>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
      v-if="!courses.length"
      indeterminate
    />
    <CourseCard
      v-for="course of filteredCourses"
      :course="course"
      :show="true"
    />
  </v-container>
</template>

<script setup>

import CourseCard from "../components/CourseCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {computed, onMounted, ref} from "vue";

const level = ref("");

const topic = ref("");

const filteredCourses = computed(() => {
  let output = [...courses.value];

  if (output.length && topic.value) {
    output = output.filter(course => {
      return course.topic === topic.value;
    });
  }

  if (output.length && level.value) {
    output = output.filter(course => {
      return course.level === level.value;
    });
  }

  return output;
})

const courses = ref([])

const topics = ["Frontend", "Backend", "Fullstack", "Cloud", "Security"];

onMounted( async ()=> {
  const coursesResponse = await getQuery('courses')

  courses.value = await coursesResponse.json()

})

</script>

<style scoped>

</style>