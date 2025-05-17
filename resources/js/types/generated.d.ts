declare namespace App.Data {
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
};
}
declare namespace App.Enums {
export type PermissionEnum = 'view_users' | 'create_users' | 'update_users' | 'delete_users' | 'restore_users';
export type RoleEnum = 'manager' | 'staff' | 'admin';
}
