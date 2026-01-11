<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { index, update } from '@/actions/App/Http/Controllers/Settings/RoleController';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Roles',
        href: index().url,
    },
];

interface Props {
    role: App.Data.RoleData;
    permissions: App.Data.PermissionData[];
}

const props = defineProps<Props>();

const form = ref({
    name: props.role.name ?? '',
    guard_name: props.role.guard_name ?? 'web',
});

const selectedPermissions = ref<number[]>(
    props.role.permissions?.map((p) => p.id).filter((id): id is number => id !== null) ?? [],
);

const permissionsArray = ref(props.permissions);

const togglePermission = (permissionId: number | null) => {
    if (!permissionId) return;
    const index = selectedPermissions.value.indexOf(permissionId);
    if (index > -1) {
        selectedPermissions.value.splice(index, 1);
    } else {
        selectedPermissions.value.push(permissionId);
    }
};

const isPermissionSelected = (permissionId: number | null): boolean => {
    return permissionId !== null && selectedPermissions.value.includes(permissionId);
};

const updateRole = () => {
    if (props.role.id) {
        router.put(
            update['/settings/roles/{role}']({ role: props.role.id }).url,
            {
                name: form.value.name,
                guard_name: form.value.guard_name,
                permissions: selectedPermissions.value,
            },
            {
                preserveScroll: true,
            },
        );
    }
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Role Details" />
        <SettingsLayout>
            <HeadingSmall title="Role" :description="`Manage role: ${role.name}`" />

            <div class="mt-6 space-y-6">
                <Card>
                    <CardHeader>
                        <CardTitle>Role Information</CardTitle>
                        <CardDescription>Update the role's basic information.</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form class="space-y-6" @submit.prevent="updateRole">
                            <div class="space-y-2">
                                <Label for="name">Name</Label>
                                <Input id="name" v-model="form.name" type="text" placeholder="Enter role name" />
                            </div>

                            <div class="space-y-2">
                                <Label for="guard_name">Guard Name</Label>
                                <Input id="guard_name" v-model="form.guard_name" type="text" placeholder="web" />
                            </div>
                        </form>
                    </CardContent>
                    <CardFooter>
                        <Button type="button" @click="updateRole">Save Changes</Button>
                    </CardFooter>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Permissions</CardTitle>
                        <CardDescription>Assign permissions to this role.</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="max-h-96 space-y-4 overflow-y-auto">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div
                                    v-for="permission in permissionsArray"
                                    :key="permission.id ?? permission.name"
                                    class="flex cursor-pointer items-start space-x-2 rounded-md border p-3 transition-colors hover:bg-neutral-50 hover:border-neutral-300 dark:hover:bg-neutral-800 dark:hover:border-neutral-700"
                                    @click="togglePermission(permission.id)"
                                >
                                    <Checkbox
                                        :id="`permission-${permission.id ?? permission.name}`"
                                        :modelValue="isPermissionSelected(permission.id)"
                                        @update:checked="(checked) => {
                                            if (checked) {
                                                if (permission.id && !selectedPermissions.value.includes(permission.id)) {
                                                    selectedPermissions.value.push(permission.id);
                                                }
                                            } else {
                                                togglePermission(permission.id);
                                            }
                                        }"
                                        @click.stop
                                    />
                                    <div class="flex flex-1 flex-col">
                                        <Label :for="`permission-${permission.id ?? permission.name}`" class="text-sm font-medium cursor-pointer">
                                            {{ permission.name }}
                                        </Label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                    <CardFooter>
                        <Button type="button" @click="updateRole">Update Permissions</Button>
                    </CardFooter>
                </Card>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
