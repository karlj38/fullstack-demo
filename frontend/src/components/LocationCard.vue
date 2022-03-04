<template>
  <v-card
      class="mx-auto my-4"
      width="300"
  >
    <v-card-title class="flex justify-space-between white--text mt-8">
      <p>
        {{location.name}}
      </p>
      <v-icon
        v-if="location.wheelchairAccessible"
        :color="'blue'"
      >
        mdi-wheelchair-accessibility
      </v-icon>
    </v-card-title>
    <v-card-text>
      <v-icon>mdi-map-marker</v-icon> {{location.city}}, {{location.country}}
    </v-card-text>
    <v-card-actions>
      <v-btn
        :to="`/locations/${location.id}`"
      >
        Show Details
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup lang="ts">
import type {Location} from "../models/location.model";
import {defineProps} from "vue";

const props = defineProps<{
  location: Location
}>()

</script>