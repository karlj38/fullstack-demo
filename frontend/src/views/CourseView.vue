<template>
  <h1>Course Details</h1>
  <v-container
      class="d-flex flex-row flex-wrap"
  >
    <v-progress-linear
    v-if="!course"
    indeterminate
    />
    <CourseCard
      v-else
      :course="course"
      :show="false"
    />
  </v-container>

  <template v-if="course && course.trainers && course.trainers.length">
    <h2>Available Trainers</h2>
    <v-container
      class="d-flex flex-row flex-wrap"
    >
      <TrainerCard
        v-for="trainer in course.trainers"
        :trainer="trainer"
      />
    </v-container>
  </template>
</template>

<script setup>

import CourseCard from "../components/CourseCard.vue";
import TrainerCard from "../components/TrainerCard.vue";
import {getQuery} from "../utils/fetchbackend";
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const course = ref([])

onMounted( async ()=> {
  const route = useRoute();
  const id = route.params.id;
  const courseResponse = await getQuery(`courses/${id}`);

  course.value = await courseResponse.json();

})

</script>

<style scoped>

</style>