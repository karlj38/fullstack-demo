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
              @change="resetForm"
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
            v-if="form.course"
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
              @change="getTrainers"
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
            v-if="form.location.id && trainers.length"
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
            v-if="form.trainer.id && students.length"
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
            v-if="form.students.length"
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
            v-if="form.start"
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
            v-if="form.start"
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
            <input
              v-model="form.cert"
              type="checkbox"
              name="cert"
            />
          </v-col>

          <!-- -------------------------------------------------------------------------------- -->

          <v-col
            v-if="form.start"
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
          v-if="form.start"
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

const courses = ref([])

const form = reactive({
  cert: false,
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

const getTrainers = async ()=> {
  // if location changes afterwards, reset form
  trainers.value = [];
  form.cert = false;
  form.comments = "";
  form.students = [];
  form.start = "";
  form.end = "";

  const trainersResponse = await getQuery('trainers', {
    city: form.location.city,
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
  const coursesResponse = await getQuery('courses');
  const locationsResponse = await getQuery('locations');
  const studentsResponse = await getQuery('students');

  courses.value = await coursesResponse.json();
  locations.value = await locationsResponse.json();
  students.value = await studentsResponse.json();

})

const resetForm = () => {
  form.cert = false,
  form.comments = "",
  form.end = "",
  form.location = {};
  form.start = "",
  form.students = [];
  form.trainer = {};
}

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