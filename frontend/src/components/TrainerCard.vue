<template>
  <v-card
      class="mx-auto my-4"
      width="300"
  >
    <v-card-title class="flex justify-space-between white--text mt-8">
      {{fullName}}
      <v-icon v-if="trainer.needWheelchair" :color="'blue'">
        mdi-wheelchair-accessibility
      </v-icon>
    </v-card-title>
    <v-card-text class="d-flex flex-wrap topics">
      <v-chip
        v-for="topic in trainer.competencies"
        :color="chipColor(topic)"
        :key="topic"
        class="mb-2 mr-2"
      >
        {{topic}}
      </v-chip>
    </v-card-text>
    <v-card-text>
      <v-icon>mdi-trending-up</v-icon> {{level}}
    </v-card-text>
    <v-card-text>
      <v-icon>mdi-map-marker</v-icon> {{trainer.city}}, {{trainer.country}}
    </v-card-text>
    <v-card-actions class="absolute bottom-0">
      <v-btn
        :to="{path: `/trainers/${trainer.id}`}"
      >
        Show Details
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup lang="ts">
import type {Trainer} from "../models/trainer.model";
import {defineProps, computed} from "vue";

const props = defineProps<{
  trainer: Trainer
}>()

const fullName = computed(()=>{
    return `${props.trainer.firstName} ${props.trainer.lastName}`
})

const level = computed(()=>{
  switch (props.trainer.level) {
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

const chipColor = topic=>{
  switch (topic) {
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
}

</script>

<style scoped>
  .topics {
    min-height: 120px;
  }
</style>