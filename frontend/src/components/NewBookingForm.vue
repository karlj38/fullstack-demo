<template>
  <v-container>
    <v-card>
      <form>
        <v-row class="pa-4">
          <v-col
            v-if="courses.length"
            cols="12"
            class="d-flex flex-column"
            md="3"
          >
            <v-card-title
              class="pa-0"
              for="course"
            >
              Select Course
            </v-card-title>
            <select
              @change="getTrainers"
              v-model="form.course"
              class="border"
              label="Select Course"
              name="course"
            >
              <option
                v-for="course in courses"
                :key="course.id"
                :value="course"
              >
                {{course.name}}
              </option>
            </select>
          </v-col>

          <!-- -------------------------------------------------------------------------------- -->

          <v-col
            v-if="form.course.id"
            class="d-flex flex-column"
            cols="12"
            md="3"
          >
            <v-card-title
              class="pa-0"
              for="trainer"
            >
              Select City
            </v-card-title>
            <select
              @change="getLocations"
              v-model="form.city"
              class="border"
              label="Select City"
              name="location"
            >
              <option
                v-for="city in cities"
                :key="city"
                :value="city"
              >
                {{city}}
              </option>
            </select>
          </v-col>

          <!-- -------------------------------------------------------------------------------- -->

          <v-col
            v-if="form.city"
            class="d-flex flex-column"
            cols="12"
            md="3"
          >
            <v-card-title
              class="pa-0"
              for="trainer"
            >
              Select Location
            </v-card-title>
            <select
              v-model="form.location"
              class="border"
              label="Select Location"
              name="location"
            >
              <option
                v-for="location in locations"
                :key="location.id"
                :value="location"
              >
                {{location.name}}
              </option>
            </select>
          </v-col>

          <!-- -------------------------------------------------------------------------------- -->

          <v-col
            v-if="form.location.id"
            class="d-flex flex-column"
            cols="12"
            md="3"
          >
            <v-card-title
              class="pa-0"
              for="trainer">Select Trainer
            </v-card-title>
            <select
              v-model="form.trainer"
              class="border"
              label="Select Trainer"
              name="trainer"
            >
              <option
                v-for="trainer in trainers"
                :key="trainer.id"
                :value="trainer"
              >
                {{trainer.firstName}} {{trainer.lastName}}
              </option>
            </select>
          </v-col>

          <!-- -------------------------------------------------------------------------------- -->

          <v-col
            v-if="form.trainer.id"
            class="d-flex flex-column"
            cols="12"
            md="3"
          >
            <v-card-title
              class="pa-0"
              for="students">Select Students
            </v-card-title>
            <select
              v-model="form.students"
              class="border"
              label="Select Students"
              multiple
              name="students"
            >
              <option
                v-for="student in students"
                :key="student.id"
                :value="student"
              >
                {{student.firstName}} {{student.lastName}}
              </option>
            </select>
          </v-col>

          <!-- -------------------------------------------------------------------------------- -->

          <v-col
            v-if="form.trainer.id"
            class="d-flex flex-column"
            cols="12"
            md="3"
          >
            <v-card-title
              class="pa-0"
              for="start"
            >
              Select Start Date
            </v-card-title>
            <input
              v-model="form.start"
              name="start"
              type="date"
            />
          </v-col>

          <v-col
            v-if="form.trainer.id"
            class="d-flex flex-column"
            cols="12"
            md="3"
          >
            <v-card-title
              class="pa-0"
              for="end"
            >
              Course End Date
            </v-card-title>
            <input
              v-model="form.end"
              name="end"
              readonly
              type="date"
            />
          </v-col>

          <!-- -------------------------------------------------------------------------------- -->

          <v-col
            v-if="form.trainer.id"
            class="d-flex flex-column"
            cols="12"
            md="3"
          >
            <v-card-title
              class="pa-0"
              for="cert"
            >
              Certificate Required
            </v-card-title>
            <v-switch
              v-model="form.cert"
              color="blue"
              type="checkbox"
              name="cert"
            />
          </v-col>

          <!-- -------------------------------------------------------------------------------- -->

          <v-col
            v-if="form.trainer.id"
            class="d-flex flex-column"
            cols="12"
          >
            <v-card-title
              class="pa-0"
              for="end"
            >
              Comments
            </v-card-title>
            <textarea
              v-model="form.comments"
              class="border"
              name="comments"
              rows="5"
            >
            </textarea>
          </v-col>
        </v-row>

        <v-card-actions
          v-if="form.trainer.id"
          class="justify-end"
        >
          <v-btn
            @click.prevent="handleSubmission"
            type="submit"
          >
            Submit
          </v-btn>
        </v-card-actions>
      </form>
    </v-card>
  </v-container>
</template>

<script setup lang="ts">
import {getQuery} from "../utils/fetchbackend";
import {onMounted, reactive, ref, watch} from "vue";

const cities = ref([])

const courses = ref([])

const form = reactive({
  cert: false,
  city: "",
  comments: "",
  course: {},
  end: "",
  location: {},
  start: "",
  students: [],
  trainer: {}
})

const locations = ref([])

const students = ref([])

const trainers = ref([])

const getLocations = async ()=> {
  // if city changes afterwards, reset form
  form.location = {};
  form.trainer = {};

  const locationsResponse = await getQuery('locations', {city:form.city});

  locations.value = await locationsResponse.json();

  getTrainers();
}

const getTrainers = async ()=> {
  form.trainer = {};
  trainers.value = [];

  const trainersResponse = await getQuery('trainers', {
    city: form.city,
    course_id: form.course.id
  });

  trainers.value = await trainersResponse.json();
}

const handleSubmission = async()=> {
  const formData = {
      course_id: form.course.id,
      location_id: form.location.id,
      trainer_id: form.trainer.id,
      student_ids: JSON.stringify(form.students.map(student => student.id)),
      start: form.start,
      end: form.end,
      certificate_needed: form.cert,
      comments: form.comments
    };

  fetch('http://localhost/api/bookings', {
    headers: {
      'Content-Type': 'application/json'
    },
    method: 'post',
    body: JSON.stringify(formData)
  })
  .then(res => res.json())
  .then(booking => {
    window.location.href = `/bookings/${booking.id}`;
  })
  .catch(err => console.log(err));
}

onMounted( async ()=> {
  const citiesResponse = await getQuery('locations', {only_cities: true});
  const coursesResponse = await getQuery('courses');
  const studentsResponse = await getQuery('students');

  cities.value = await citiesResponse.json();
  courses.value = await coursesResponse.json();
  students.value = await studentsResponse.json();

})

watch(() => form.start, start => {
  if (start) {
    const date = new Date(start);
    let end = new Date(start);
    end.setDate(date.getDate() + form.course.duration);
    form.end = end.toISOString().split("T")[0];
  }
})

</script>

<style scoped>

</style>