import type { Trainer } from "./trainer.model";

export interface Course {
    id: number;
    name: string;
    topic: 'Frontend' | 'Backend' | 'Fullstack' | 'Cloud' | 'Security';
    level: number;
    duration: number;
    created_at: Date;
    updated_at: Date;
    trainers: Array<Trainer>
}