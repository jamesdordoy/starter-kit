declare namespace App.Data {
export type ActivityData = {
id: number;
log_name: string | null;
description: string;
subject_type: string | null;
subject_id: number | null;
causer_type: string | null;
causer_id: number | null;
causer: App.Data.UserData | null;
properties: any;
created_at: string | null;
updated_at: string | null;
formatted_created_at: string | null;
};
export type MediaData = {
id: number | null;
model_type: string | null;
model_id: number | null;
uuid: string | null;
collection_name: string | null;
name: string | null;
file_name: string | null;
mime_type: string | null;
disk: string | null;
conversions_disk: string | null;
size: number | null;
manipulations: Array<any> | null;
custom_properties: Array<any> | null;
generated_conversions: Array<any> | null;
responsive_images: Array<any> | null;
order_column: number | null;
created_at: string | null;
updated_at: string | null;
};
export type PermissionData = {
id: number | null;
name: string | null;
guard_name: string | null;
created_at: string | null;
updated_at: string | null;
};
export type RoleData = {
id: number | null;
name: string | null;
guard_name: string | null;
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
permissions: Array<App.Data.PermissionData> | null;
roles: Array<App.Data.RoleData> | null;
formatted_email_verified_at: string | null;
};
}
declare namespace App.Data.Pages.Settings.Profile {
export type EditProfileData = {
must_verify_email: boolean;
status: string | null;
user: App.Data.UserData;
};
}
declare namespace App.Enums {
export type ActivityLogEnum = 'view' | 'created' | 'updated' | 'deleted' | 'restored' | 'forceDeleted' | 'login' | 'logout' | 'register' | 'impersonate' | 'leaveImpersonation' | 'mediaAdded';
export type FilterEnum = 'search' | 'date' | 'date_from' | 'date_to' | 'date_range' | 'description';
export type MediaCollectionEnum = 'default' | 'avatars';
export type PermissionEnum = 'view_users' | 'create_users' | 'update_users' | 'delete_users' | 'restore_users' | 'view_settings' | 'view_activity_log';
export type RoleEnum = 'manager' | 'staff' | 'admin';
}
declare namespace App.QueryBuilder.Data {
export type QueryBuilderParams = {
per_page: string | null;
filter: Array<any>;
sort: string | null;
include: Array<any>;
};
}
declare namespace App.Settings {
export type SiteSettings = {
logo_media_id: string | null;
};
}
