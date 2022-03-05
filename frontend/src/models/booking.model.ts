export interface Booking {
    id: number;
    course_id: number;
    location_id: number;
    trainer_id: number;
    students: Array<number | Object>;
    start: Date;
    end: Date;
    certificate_needed: Boolean;
    comments: String;
    created_at: Date;
    updated_at: Date;
    course: Object;
    location: Object;
    trainer: Object;
}