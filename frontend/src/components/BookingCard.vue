<template>
  <v-card
      class="d-flex flex-column mx-auto my-4"
      width="300"
  >
    <v-card-title class="white--text mt-8">
      <p>
        {{booking.course.name}}
      </p>
    </v-card-title>
    <v-card-text>
      <v-chip
        :color="chipColor"
        outlined
      >
        {{booking.course.topic}}
      </v-chip>
    </v-card-text>
    <v-card-text>
      <v-icon>mdi-map-marker</v-icon>
      <a :href="`courses/${booking.course_id}`">
        {{booking.location.name}}
      </a>
    </v-card-text>
    <v-card-text v-if="booking.trainer">
      <v-icon>mdi-account</v-icon>
      <a :href="`trainer/${booking.trainer_id}`">
        {{fullName}}
      </a>
    </v-card-text>
    <v-card-text>
      <v-icon>mdi-trending-up</v-icon> {{level}}
    </v-card-text>
    <v-card-text>
      <v-icon>mdi-calendar-start</v-icon> {{booking.start}}
    </v-card-text>
    <v-card-text>
      <v-icon>mdi-calendar-end</v-icon> {{booking.end}}
    </v-card-text>
    <v-card-text v-if="booking.certificate_needed">
      <v-icon>mdi-certificate</v-icon> Certificate Required
    </v-card-text>
    <v-card-actions
      v-if="show"
      class="align-end"
    >
      <v-btn
        :to="`/bookings/${booking.id}`"
      >
        Show Details
      </v-btn>
    </v-card-actions>
    <v-card-text v-else>
      <v-icon>mdi-comment-text</v-icon> {{booking.comments}}
    </v-card-text>
  </v-card>
</template>

<script setup lang="ts">
import type {Booking} from "../models/booking.model";
import {ref, toRef, defineProps, computed} from "vue";

const props = defineProps<{
  booking: Booking,
  show: Boolean
}>()

const fullName = computed(()=>{
    return `${props.booking.trainer.firstName} ${props.booking.trainer.lastName}`
})

const level = computed(()=>{
  switch (props.booking.course.level) {
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
  switch (props.booking.course.topic) {
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

a {
  text-decoration: none;
}
</style>