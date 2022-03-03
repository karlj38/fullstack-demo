export interface Booking {
    id: number;
    course_id: number;
    location_id: number;
    trainer_id: number;
    students: Array<number>;
    start: Date;
    end: Date;
    certificate_needed: Boolean;
    comments: String;
    created_at: Date;
    updated_at: Date;
}