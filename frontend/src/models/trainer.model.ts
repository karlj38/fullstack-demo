export interface Trainer {
    id: number;
    firstName: String;
    lastName: String;
    level: number;
    competencies: Array<String>;
    needWheelchair: Boolean;
    city: String;
    country: String;
    created_at: Date;
    updated_at: Date;
}