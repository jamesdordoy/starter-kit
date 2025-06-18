<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import TagsInput from '@/components/ui/tags-input/TagsInput.vue';
import UserInfo from '@/components/UserInfo.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import type { Collection } from '@/types/collection';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: route('settings.users.index'),
    },
];

interface Props {
    user: App.Data.UserData;
    permissions: Collection<App.Data.PermissionData>;
    roles: App.Data.RoleData[];
    params: {
        page: number;
        per_page: number;
        sortColumn: string;
        sortDirection: string;
        search: string;
    };
}

const props = defineProps<Props>();

const form = ref({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
});

const selectedRoles = ref<App.Data.RoleData[]>(props.user.roles ?? []);
const selectedPermissions = ref<Record<string, boolean>>(
    props.permissions.data.reduce(
        (acc, permission) => ({
            ...acc,
            [permission.name]: false,
        }),
        {},
    ),
);

// Convert roles collection to array for TagsInput
const rolesArray = ref<App.Data.RoleData[]>(props.roles);

// Initialize permissions based on user's existing permissions
const initializePermissions = () => {
    props.permissions.data.forEach((permission) => {
        selectedPermissions.value[permission.name] = props.user.permissions?.some((userPerm) => userPerm.name === permission.name) ?? false;
    });
};

initializePermissions();

// Form submission handlers
const updateUserInfo = () => {
    // TODO: Implement user info update
    console.log('Update user info:', form.value);
};

const updatePassword = () => {
    // TODO: Implement password update
    console.log('Update password:', form.value);
};

const updateRolesAndPermissions = () => {
    if (props.user.id) {
        router.put(route('settings.users.roles-permissions.update', props.user.id), {
            roles: selectedRoles.value,
            permissions: selectedPermissions.value,
        }, {
            preserveScroll: true
        });
    }
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="User Settings" />
        <SettingsLayout>
            <HeadingSmall title="User" description="View and manage your site Users" />

            <div class="mt-6 space-y-6">
                <Card>
                    <CardHeader>
                        <div class="flex items-center gap-4">
                            <UserInfo :user="user" :show-email="false" class="flex items-center gap-3" />
                        </div>
                        <CardTitle class="mt-4">User Information</CardTitle>
                        <CardDescription>Update the user's information.</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form class="space-y-6" @submit.prevent="updateUserInfo">
                            <div class="space-y-2">
                                <Label for="name">Name</Label>
                                <Input id="name" v-model="form.name" type="text" placeholder="Enter name" />
                            </div>

                            <div class="space-y-2">
                                <Label for="email">Email</Label>
                                <Input id="email" v-model="form.email" type="email" placeholder="Enter email" />
                            </div>
                        </form>
                    </CardContent>
                    <CardFooter>
                        <Button type="button" @click="updateUserInfo">Save Changes</Button>
                    </CardFooter>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>User Password</CardTitle>
                        <CardDescription>Update the user's password.</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form class="space-y-6" @submit.prevent="updatePassword">
                            <div class="space-y-2">
                                <Label for="password">Password</Label>
                                <Input id="password" v-model="form.password" type="password" placeholder="Enter new password" />
                            </div>

                            <div class="space-y-2">
                                <Label for="password_confirmation">Confirm Password</Label>
                                <Input
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    placeholder="Confirm new password"
                                />
                            </div>
                        </form>
                    </CardContent>
                    <CardFooter>
                        <Button type="button" @click="updatePassword">Update Password</Button>
                    </CardFooter>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Roles & Permissions</CardTitle>
                        <CardDescription>Manage the user's roles and permissions.</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form class="space-y-6" @submit.prevent="updateRolesAndPermissions">
                            <div class="space-y-2">
                                <Label for="role">Role</Label>
                                <TagsInput v-model="selectedRoles" :items="rolesArray" placeholder="Search roles..." />
                            </div>

                            <div class="space-y-4">
                                <Label>Permissions</Label>
                                <div class="grid gap-4">
                                    <div v-for="permission in props.permissions.data" :key="permission.name" class="flex items-center space-x-2">
                                        <Checkbox :id="permission.name" v-model="selectedPermissions[permission.name]" />
                                        <Label :for="permission.name" class="text-sm font-normal">{{ permission.name }}</Label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </CardContent>
                    <CardFooter>
                        <Button type="button" @click="updateRolesAndPermissions">Update Roles &amp; Permissions</Button>
                    </CardFooter>
                </Card>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
