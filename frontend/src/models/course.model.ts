export interface Course {
    id: string;
    name: string;
    topic: 'Frontend' | 'Backend' | 'Fullstack' | 'Cloud' | 'Security';
    level: number;
    duration: number;
}