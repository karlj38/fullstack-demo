export interface Course {
    id: number;
    name: string;
    topic: 'Frontend' | 'Backend' | 'Fullstack' | 'Cloud' | 'Security';
    level: number;
    duration: number;
    created_at: Date;
    updated_at: Date;
}