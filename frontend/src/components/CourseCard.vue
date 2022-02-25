<template>
  <v-card
      class="mx-auto my-4"
      width="300"
  >
    <v-card-title class="white--text mt-8">
      <p class="ml-3">
        {{course.name}}
      </p>
    </v-card-title>
    <v-card-text>
      <div class="font-weight-bold ml-8 mb-2">
        Topic: <v-chip outlined :color="chipColor">{{course.topic}}</v-chip>
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn
          color="text-green lighten-2"
          text
          @click="show = !show"
      >
        Show Details
      </v-btn>

      <v-spacer></v-spacer>

      <v-btn
          icon
          @click="show = !show"
      >
        <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
      </v-btn>
    </v-card-actions>

    <v-expand-transition>
      <div v-show="show">
        <v-divider></v-divider>

        <v-card-text>
          Level: {{level}}
        </v-card-text>
        <v-card-text>
          Duration: {{course.duration}} {{course.duration === 1? 'day': 'days'}}
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>

<script setup lang="ts">
import type {Course} from "../models/course.model";
import {ref, toRef, defineProps, computed} from "vue";

const props = defineProps<{
  course: Course
}>()

const show = ref(false)

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