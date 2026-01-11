import UserController from './UserController'
import RoleController from './RoleController'
import PermissionController from './PermissionController'
import ActivityLogController from './ActivityLogController'
import MediaController from './MediaController'
import LogoController from './LogoController'
import ProfileController from './ProfileController'
import ProfileAvatarController from './ProfileAvatarController'
import PasswordController from './PasswordController'
import SettingController from './SettingController'

const Settings = {
    UserController: Object.assign(UserController, UserController),
    RoleController: Object.assign(RoleController, RoleController),
    PermissionController: Object.assign(PermissionController, PermissionController),
    ActivityLogController: Object.assign(ActivityLogController, ActivityLogController),
    MediaController: Object.assign(MediaController, MediaController),
    LogoController: Object.assign(LogoController, LogoController),
    ProfileController: Object.assign(ProfileController, ProfileController),
    ProfileAvatarController: Object.assign(ProfileAvatarController, ProfileAvatarController),
    PasswordController: Object.assign(PasswordController, PasswordController),
    SettingController: Object.assign(SettingController, SettingController),
}

export default Settings