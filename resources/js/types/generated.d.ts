declare namespace App.Data {
    export type ActivityData = {
        id: number;
        log_name: string;
        description: string;
        subject_type: string | null;
        subject_id: number | null;
        causer_type: string | null;
        causer_id: number | null;
        causer: App.Data.UserData | null;
        properties: any;
        created_at: string;
        updated_at: string;
        formatted_created_at: string | null;
    };
    export type MediaData = {
        id: number;
        model_type: string;
        model_id: number;
        uuid: string | null;
        collection_name: string;
        name: string;
        file_name: string;
        mime_type: string | null;
        disk: string;
        conversions_disk: string | null;
        size: number;
        manipulations: Array<any>;
        custom_properties: Array<any>;
        generated_conversions: Array<any>;
        responsive_images: Array<any>;
        order_column: number | null;
        created_at: string | null;
        updated_at: string | null;
    };
    export type UserData = {
        id: number | null;
        name: string;
        email: string;
        password: string | null;
        avatar: string | null;
        two_factor_secret: string | null;
        two_factor_recovery_codes: string | null;
        remember_token: string | null;
        two_factor_confirmed_at: string | null;
        email_verified_at: string | null;
        created_at: string | null;
        updated_at: string | null;
        formatted_email_verified_at: string | null;
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
    export type QueryBuilderParams = {
        per_page: string | null;
        filter: Array<any> | null;
        sort: string | null;
        include: Array<any> | null;
    };
}
declare namespace App.Settings {
    export type SiteSettings = {
        logo_media_id: string | null;
    };
}
