<?php

declare(strict_types=1);

namespace App\Enums;

enum PermissionEnum: string
{
	case CREATE_MEDIA_ITEMS = 'create_media_items';
	case CREATE_PERMISSIONS = 'create_permissions';
	case CREATE_ROLES = 'create_roles';
	case CREATE_SETTINGS = 'create_settings';
	case CREATE_USERS = 'create_users';
	case DASHBOARD = 'dashboard';
	case DELETE_MEDIA_ITEMS = 'delete_media_items';
	case DELETE_PERMISSIONS = 'delete_permissions';
	case DELETE_PROFILE = 'delete_profile';
	case DELETE_ROLES = 'delete_roles';
	case DELETE_SETTINGS = 'delete_settings';
	case DELETE_USERS = 'delete_users';
	case LOGOUT = 'logout';
	case PROFILE_AVATAR = 'profile_avatar';
	case SETTINGS_IMPERSONATE = 'settings_impersonate';
	case SETTINGS_IMPERSONATE_LEAVE = 'settings_impersonate_leave';
	case STORAGE_LOCAL = 'storage_local';
	case UPDATE_LOGO = 'update_logo';
	case UPDATE_MEDIA_ITEMS = 'update_media_items';
	case UPDATE_PERMISSIONS = 'update_permissions';
	case UPDATE_PROFILE = 'update_profile';
	case UPDATE_ROLES = 'update_roles';
	case UPDATE_ROLES_PERMISSIONS = 'update_roles_permissions';
	case UPDATE_SETTINGS = 'update_settings';
	case UPDATE_USER_PASSWORD = 'update_user_password';
	case UPDATE_USER_PROFILE_INFORMATION = 'update_user_profile_information';
	case UPDATE_USERS = 'update_users';
	case VIEW_ACTIVITY = 'view_activity';
	case VIEW_MEDIA_ITEMS = 'view_media_items';
	case VIEW_PERMISSIONS = 'view_permissions';
	case VIEW_ROLES = 'view_roles';
	case VIEW_SETTINGS = 'view_settings';
	case VIEW_USERS = 'view_users';

    /**
     * Get all routes associated with this permission
     *
     * @return array<string>
     */
    public function routes(): array
    {
        return match ($this) {
			self::CREATE_MEDIA_ITEMS => ['settings.media-items.create', 'settings.media-items.store'],
			self::CREATE_PERMISSIONS => ['settings.permissions.create', 'settings.permissions.store'],
			self::CREATE_ROLES => ['settings.roles.create', 'settings.roles.store'],
			self::CREATE_SETTINGS => ['settings.create', 'settings.store'],
			self::CREATE_USERS => ['settings.users.create', 'settings.users.store'],
			self::DASHBOARD => ['dashboard'],
			self::DELETE_MEDIA_ITEMS => ['settings.media-items.destroy'],
			self::DELETE_PERMISSIONS => ['settings.permissions.destroy'],
			self::DELETE_PROFILE => ['profile.destroy'],
			self::DELETE_ROLES => ['settings.roles.destroy'],
			self::DELETE_SETTINGS => ['settings.destroy'],
			self::DELETE_USERS => ['settings.users.destroy'],
			self::LOGOUT => ['logout'],
			self::PROFILE_AVATAR => ['profile.avatar'],
			self::SETTINGS_IMPERSONATE => ['settings.impersonate'],
			self::SETTINGS_IMPERSONATE_LEAVE => ['settings.impersonate.leave'],
			self::STORAGE_LOCAL => ['storage.local'],
			self::UPDATE_LOGO => ['settings.logo.update'],
			self::UPDATE_MEDIA_ITEMS => ['settings.media-items.edit', 'settings.media-items.update'],
			self::UPDATE_PERMISSIONS => ['settings.permissions.edit', 'settings.permissions.update'],
			self::UPDATE_PROFILE => ['profile.edit', 'profile.update'],
			self::UPDATE_ROLES => ['settings.roles.edit', 'settings.roles.update'],
			self::UPDATE_ROLES_PERMISSIONS => ['settings.users.roles-permissions.update'],
			self::UPDATE_SETTINGS => ['settings.edit', 'settings.update'],
			self::UPDATE_USER_PASSWORD => ['user-password.update'],
			self::UPDATE_USER_PROFILE_INFORMATION => ['user-profile-information.update'],
			self::UPDATE_USERS => ['settings.users.edit', 'settings.users.update'],
			self::VIEW_ACTIVITY => ['settings.activity.index', 'settings.activity.show'],
			self::VIEW_MEDIA_ITEMS => ['settings.media-items.index', 'settings.media-items.show'],
			self::VIEW_PERMISSIONS => ['settings.permissions.index', 'settings.permissions.show'],
			self::VIEW_ROLES => ['settings.roles.index', 'settings.roles.show'],
			self::VIEW_SETTINGS => ['settings.index', 'settings.show'],
			self::VIEW_USERS => ['settings.users.index', 'settings.users.show'],
        };
    }
}
