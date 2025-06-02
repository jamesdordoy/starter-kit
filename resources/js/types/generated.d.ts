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
    export type MediaData = {
        id: number;
        modelType: string;
        modelId: number;
        uuid: string | null;
        collectionName: string;
        name: string;
        fileName: string;
        mimeType: string | null;
        disk: string;
        conversionsDisk: string | null;
        size: number;
        manipulations: Array<any>;
        customProperties: Array<any>;
        generatedConversions: Array<any>;
        responsiveImages: Array<any>;
        orderColumn: number | null;
        createdAt: string | null;
        updatedAt: string | null;
    };
    export type UserData = {
        id: number | null;
        name: string;
        email: string;
        password: string | null;
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
    export type MediaCollectionEnum = 'avatars';
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
declare namespace App.QueryBuilder.Data {
    export type Filter = {
        value: string | null;
    };
    export type QueryBuilderParams = {
        per_page: string | null;
        filter: any | null;
        sort: string | null;
        include: Array<any> | null;
    };
}
