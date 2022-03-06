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
    <v-col md="2">
      <v-select
        v-model="sort"
        :items="['Level', 'Name', 'Topic']"
        label="Sort by"
      />
    </v-col>
    <v-col md="2">
      <v-select
        v-model="order"
        :items="['Ascending', 'Descending']"
        label="Order by"
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

const order = ref("Ascending")

const sort = ref("Name");

const topic = ref("");

const filteredCourses = computed(() => {
  let output = [...courses.value];

  if (output.length) {
    if (topic.value) {
      output = output.filter(course => {
        return course.topic === topic.value;
      });
    }

    if (level.value) {
      output = output.filter(course => {
        return course.level === level.value;
      });
    }

    const sortBy = sort.value.toLowerCase();
    const orderBy = order.value === "Ascending" ? 1 : -1
    output.sort((a, b) => a[sortBy] > b[sortBy] ? orderBy : -orderBy);
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