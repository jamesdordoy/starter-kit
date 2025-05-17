<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import { Link, router } from '@inertiajs/vue3';
import { LogOut, Settings } from 'lucide-vue-next';
import { usePage } from '@inertiajs/vue3';
import { type SharedData } from '@/types';

const handleLogout = () => {
    router.flushAll();
};
const page = usePage<SharedData>();
const user = page.props.auth.user as App.Data.UserData;
</script>

<template>
    <DropdownMenuLabel class="p-0 font-normal hover:bg-accent">
        <Link class="flex items-center gap-2 px-1 py-1.5 text-left text-sm" :href="route('profile.edit', { profile: user })" prefetch as="button">
            <UserInfo :user="user" :show-email="true" />
        </Link>
    </DropdownMenuLabel>
    <DropdownMenuSeparator v-if="page.props.auth.can.view_settings" />
    <DropdownMenuGroup v-if="page.props.auth.can.view_settings">
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full" :href="route('settings.index')" prefetch as="button">
                <Settings class="mr-2 h-4 w-4" />
                Settings
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
    <DropdownMenuSeparator />
    <DropdownMenuItem :as-child="true">
        <Link class="block w-full" method="post" :href="route('logout')" @click="handleLogout" as="button">
            <LogOut class="mr-2 h-4 w-4" />
            Log out
        </Link>
    </DropdownMenuItem>
</template>
