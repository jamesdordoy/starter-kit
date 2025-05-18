import type { User } from './user';

export interface ActivityLog {
    id: number;
    log_name: string;
    description: string;
    subject_type: string | null;
    subject_id: number | null;
    causer_type: string | null;
    causer_id: number | null;
    causer: User | null;
    properties: Record<string, any>;
    created_at: string;
    updated_at: string;
    formatted_created_at: string | null;
} 