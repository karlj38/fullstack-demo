<template>
  <v-card
      class="mx-auto my-4"
      width="300"
  >
    <v-card-title class="flex justify-space-between white--text mt-8">
      <p>
        {{fullName}}
      </p>
      <v-icon
        v-if="student.needWheelchair"
        :color="'blue'"
      >
        mdi-wheelchair-accessibility
      </v-icon>
    </v-card-title>
    <v-card-text>
      <v-icon>mdi-email</v-icon>&nbsp;
      <a
        :href="`mailto:${student.email}`"
        :title="`Email ${fullName}`"
        target="_blank"
      >
        {{student.email}}
      </a>
    </v-card-text>
    <v-card-actions v-if="show">
      <v-btn
        :to="`/students/${student.id}`"
      >
        Show Details
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup lang="ts">
import type {Student} from "../models/student.model";
import {defineProps, computed} from "vue";

const props = defineProps<{
  student: Student,
  show: Boolean
}>()

const fullName = computed(()=>{
    return `${props.student.firstName} ${props.student.lastName}`
})

</script>

<style scoped>

</style>