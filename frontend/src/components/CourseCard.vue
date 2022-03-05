<template>
  <v-card
      class="mx-auto my-4"
      width="300"
  >
    <v-card-title class="white--text mt-8">
      <p>
        {{course.name}}
      </p>
    </v-card-title>
    <v-card-text>
      <v-chip
        :color="chipColor"
        outlined
      >
        {{course.topic}}
      </v-chip>
    </v-card-text>
    <v-card-text>
      <v-icon>mdi-trending-up</v-icon> {{level}}
    </v-card-text>
    <v-card-text>
      <v-icon>mdi-calendar</v-icon> {{course.duration}} {{course.duration === 1? 'day': 'days'}}
    </v-card-text>
    <v-card-actions v-if="show">
      <v-btn
        :to="`/courses/${course.id}`"
      >
        Show Details
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup lang="ts">
import type {Course} from "../models/course.model";
import {defineProps, computed} from "vue";

const props = defineProps<{
  course: Course,
  show: Boolean
}>()

const level = computed(()=>{
  switch (props.course.level) {
    case 1:
      return 'Beginner'
    case 2:
      return 'Improver'
    case 3:
      return 'Intermediate'
    case 4:
      return 'Experienced'
    case 5:
      return 'Expert'
  }
})

const chipColor = computed(()=>{
  switch (props.course.topic) {
    case "Backend":
      return 'red'
    case "Cloud":
      return 'blue'
    case "Frontend":
      return 'green'
    case "Fullstack":
      return 'primary'
    case "Security":
      return 'orange'
  }
})

</script>

<style scoped>

</style>