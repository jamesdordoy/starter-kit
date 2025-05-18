import type { User } from './user';

export interface ActivityLog {
    id: number;
    log_name: string;
    description: string;
    causer: User | null;
    properties: Record<string, any>;
    created_at: string;
} 