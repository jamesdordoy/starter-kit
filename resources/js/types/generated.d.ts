declare namespace App.Data {
    export type ActivityData = {
        id: number;
        logName: string;
        description: string;
        subjectType: string | null;
        subjectId: number | null;
        causerType: string | null;
        causerId: number | null;
        causer: App.Data.UserData | null;
        properties: Array<any>;
        createdAt: string;
        updatedAt: string;
        formattedCreatedAt: string | null;
    };
    export type UserData = {
        id: number | null;
        name: string;
        email: string;
        password: string;
        avatar: string | null;
        twoFactorSecret: string | null;
        twoFactorRecoveryCodes: string | null;
        rememberToken: string | null;
        twoFactorConfirmedAt: string | null;
        emailVerifiedAt: string | null;
        createdAt: string | null;
        updatedAt: string | null;
        formattedEmailVerifiedAt: string | null;
    };
}
declare namespace App.Enums {
    export type ActivityLogEnum = 'view' | 'create' | 'update' | 'delete' | 'restore' | 'login' | 'logout' | 'register';
    export type PermissionEnum =
        | 'view_users'
        | 'create_users'
        | 'update_users'
        | 'delete_users'
        | 'restore_users'
        | 'view_settings'
        | 'view_activity_log';
    export type RoleEnum = 'manager' | 'staff' | 'admin';
}
