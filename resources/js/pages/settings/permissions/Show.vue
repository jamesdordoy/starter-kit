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
import { index, update } from '@/actions/App/Http/Controllers/Settings/PermissionController';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Permissions',
        href: index().url,
    },
];

interface Props {
    permission: App.Data.PermissionData;
    routes: App.Data.RouteData[];
}

const props = defineProps<Props>();

const form = ref({
    name: props.permission.name,
    guard_name: props.permission.guard_name ?? 'web',
});

const selectedRoutes = ref<number[]>(
    props.permission.routes?.map((r) => r.id).filter((id): id is number => id !== null) ?? [],
);

const routesArray = ref(props.routes);

const updatePermission = () => {
    if (props.permission.id) {
        router.put(
            update['/settings/permissions/{permission}']({ permission: props.permission.id }).url,
            {
                name: form.value.name,
                guard_name: form.value.guard_name,
                routes: selectedRoutes.value,
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
        <Head title="Permission Details" />
        <SettingsLayout>
            <HeadingSmall title="Permission" :description="`Manage permission: ${permission.name}`" />

            <div class="mt-6 space-y-6">
                <Card>
                    <CardHeader>
                        <CardTitle>Permission Information</CardTitle>
                        <CardDescription>Update the permission's basic information.</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form class="space-y-6" @submit.prevent="updatePermission">
                            <div class="space-y-2">
                                <Label for="name">Name</Label>
                                <Input id="name" v-model="form.name" type="text" placeholder="Enter permission name" />
                            </div>

                            <div class="space-y-2">
                                <Label for="guard_name">Guard Name</Label>
                                <Input id="guard_name" v-model="form.guard_name" type="text" placeholder="web" />
                            </div>
                        </form>
                    </CardContent>
                    <CardFooter>
                        <Button type="button" @click="updatePermission">Save Changes</Button>
                    </CardFooter>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Routes</CardTitle>
                        <CardDescription>Assign routes to this permission. Users with this permission will have access to these routes.</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="max-h-96 space-y-4 overflow-y-auto">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div
                                    v-for="route in routesArray"
                                    :key="route.id"
                                    class="flex cursor-pointer items-start space-x-2 rounded-md border p-3 transition-colors hover:bg-neutral-50 hover:border-neutral-300 dark:hover:bg-neutral-800 dark:hover:border-neutral-700"
                                    @click="() => {
                                        if (route.id) {
                                            const isSelected = selectedRoutes.includes(route.id);
                                            if (isSelected) {
                                                selectedRoutes = selectedRoutes.filter(id => id !== route.id);
                                            } else {
                                                selectedRoutes.push(route.id);
                                            }
                                        }
                                    }"
                                >
                                    <Checkbox
                                        :id="`route-${route.id}`"
                                        :checked="selectedRoutes.includes(route.id ?? 0)"
                                        @update:checked="(checked) => {
                                            if (checked) {
                                                if (route.id && !selectedRoutes.includes(route.id)) {
                                                    selectedRoutes.push(route.id);
                                                }
                                            } else {
                                                if (route.id) {
                                                    selectedRoutes = selectedRoutes.filter(id => id !== route.id);
                                                }
                                            }
                                        }"
                                        @click.stop
                                    />
                                    <div class="flex flex-1 flex-col">
                                        <Label :for="`route-${route.id}`" class="text-sm font-medium cursor-pointer">
                                            {{ route.name }}
                                        </Label>
                                        <span class="text-xs text-muted-foreground">
                                            {{ route.method }} {{ route.uri }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                    <CardFooter>
                        <Button type="button" @click="updatePermission">Update Routes</Button>
                    </CardFooter>
                </Card>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
