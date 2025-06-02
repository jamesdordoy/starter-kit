<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';

import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { getInitials } from '@/composables/useInitials';
import AppLayout from '@/layouts/AppLayout.vue';
import ProfileLayout from '@/layouts/profile/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { useForm as intertiaForm, router } from '@inertiajs/vue3';
import { useForm } from 'laravel-precognition-vue-inertia';
import { computed } from 'vue';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
    user: App.Data.UserData;
}

const props = defineProps<Props>();

const page = usePage();
const auth = computed(() => page.props.auth);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: route('profile.update', { profile: props.user }),
    },
];

const form = useForm('patch', route('profile.update', { profile: props.user }), {
    name: props.user.name,
    email: props.user.email,
});

const submit = async () => {
    await form.submit();
};

const avatarForm = intertiaForm({
    avatar: null,
});

const uploadAvatar = async () => {
    try {
        await avatarForm.post(route('profile.avatar'), {
            forceFormData: true,
            preserveScroll: true,
        });

        avatarForm.reset();

        router.reload();
    } catch (error) {
        console.error(error);
    }
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Profile settings" />

        <ProfileLayout :user="props.user">
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Profile information" description="Update your name and email address" />

                <div class="flex">
                    <Avatar class="size-20 overflow-hidden rounded-full">
                        <AvatarImage v-if="auth.user.avatar" :src="auth.user.avatar" :alt="auth.user.name" />
                        <AvatarFallback class="rounded-lg bg-neutral-200 font-semibold text-black dark:bg-neutral-700 dark:text-white">
                            {{ getInitials(auth.user?.name) }}
                        </AvatarFallback>
                    </Avatar>
                    <form @submit.prevent="uploadAvatar">
                        <div class="ml-4 flex flex-col space-y-4">
                            <div class="relative">
                                <input
                                    type="file"
                                    @input="avatarForm.avatar = $event.target.files[0]"
                                    class="peer absolute inset-0 h-full w-full cursor-pointer opacity-0"
                                    accept="image/*"
                                />
                                <div
                                    class="flex h-10 items-center justify-center rounded-md border border-neutral-200 bg-white px-4 text-sm text-neutral-600 transition-colors peer-hover:border-neutral-300 hover:bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700"
                                >
                                    <span>{{ avatarForm.avatar ? avatarForm.avatar.name : 'Choose avatar' }}</span>
                                </div>
                            </div>

                            <div v-if="avatarForm.progress" class="w-full">
                                <div class="mb-1 flex justify-between text-sm">
                                    <span class="text-neutral-600 dark:text-neutral-300">Uploading...</span>
                                    <span class="text-neutral-600 dark:text-neutral-300">{{ avatarForm.progress.percentage }}%</span>
                                </div>
                                <div class="h-2 w-full overflow-hidden rounded-full bg-neutral-200 dark:bg-neutral-700">
                                    <div
                                        class="bg-primary h-full rounded-full transition-all duration-300 ease-in-out"
                                        :style="{ width: `${avatarForm.progress.percentage}%` }"
                                    ></div>
                                </div>
                            </div>

                            <Button :disabled="avatarForm.processing" class="w-full">
                                <span v-if="avatarForm.processing">Uploading...</span>
                                <span v-else>Save Avatar</span>
                            </Button>
                        </div>
                    </form>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autocomplete="name"
                            placeholder="Full name"
                            @update:model-value="form.validate('name')"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="Email address"
                            @update:model-value="form.validate('email')"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !props.user.emailVerifiedAt">
                        <p class="text-muted-foreground -mt-4 text-sm">
                            Your email address is unverified.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                            >
                                Click here to resend the verification email.
                            </Link>
                        </p>

                        <div v-if="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-600">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="form.processing">Save</Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>

            <DeleteUser :user="props.user" />
        </ProfileLayout>
    </AppLayout>
</template>
