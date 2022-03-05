import type { Course } from "./course.model";
import type { Location } from "./location.model";
import type { Student } from "./student.model";
import type { Trainer } from "./trainer.model";

export interface Booking {
    id: number;
    course_id: number;
    location_id: number;
    trainer_id: number;
    students: Array<number | Student>;
    start: Date;
    end: Date;
    certificate_needed: Boolean;
    comments: String;
    created_at: Date;
    updated_at: Date;
    course: Course;
    location: Location;
    trainer: Trainer;
}