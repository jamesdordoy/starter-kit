<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import { type SharedData } from '@/types';
import { Link, router, usePage } from '@inertiajs/vue3';
import { LogOut, Settings } from 'lucide-vue-next';
import { edit } from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { index } from '@/actions/App/Http/Controllers/Settings/SettingController';
import { leave } from '@/actions/Lab404/Impersonate/Controllers/ImpersonateController';
import { destroy } from '@/actions/Laravel/Fortify/Http/Controllers/AuthenticatedSessionController';

const handleLogout = () => {
    router.flushAll();
};
const page = usePage<SharedData>();
const user = page.props.auth.user as App.Data.UserData;

const stopImpersonate = () => {
    window.location.href = leave().url;
};
</script>

<template>
    <DropdownMenuLabel class="hover:bg-accent p-0 font-normal">
        <Link class="flex items-center gap-2 px-1 py-1.5 text-left text-sm" :href="edit({ profile: user }).url" prefetch as="button">
            <UserInfo :user="user" :show-email="true" />
        </Link>
    </DropdownMenuLabel>
    <DropdownMenuSeparator v-if="page.props.auth.can.view_settings || page.props.auth.impersonator" />
    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true" v-if="page.props.auth.can.view_settings">
            <Link class="block w-full" :href="index().url" prefetch as="button">
                <Settings class="mr-2 h-4 w-4" />
                Settings
            </Link>
        </DropdownMenuItem>

        <DropdownMenuItem :as-child="true" v-if="page.props.auth.impersonator">
            <a @click="stopImpersonate" class="block w-full">
                <font-awesome-icon icon="user-secret" class="mr-2" />
                Stop Impersonation
            </a>
        </DropdownMenuItem>
    </DropdownMenuGroup>
    <DropdownMenuSeparator />
    <DropdownMenuItem :as-child="true">
        <Link class="block w-full" method="post" :href="destroy().url" @click="handleLogout" as="button">
            <LogOut class="mr-2 h-4 w-4" />
            Log out
        </Link>
    </DropdownMenuItem>
</template>
