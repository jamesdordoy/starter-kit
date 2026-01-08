<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import { store } from '@/actions/Laravel/Fortify/Http/Controllers/RegisteredUserController';
import { create as loginCreate } from '@/actions/Laravel/Fortify/Http/Controllers/AuthenticatedSessionController';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const isVisible = ref(false);
const contentVisible = ref(false);

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
        setTimeout(() => {
            contentVisible.value = true;
        }, 500);
    }, 100);
});

const submit = () => {
    form.post(store.url, {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-b from-blue-50 to-white dark:from-blue-950 dark:to-gray-950">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="animate-blob absolute -top-1/2 -left-1/2 h-[1000px] w-[1000px] rounded-full bg-blue-300/30 blur-3xl dark:bg-blue-500/20"
            ></div>
            <div
                class="animate-blob animation-delay-2000 absolute -right-1/2 -bottom-1/2 h-[1000px] w-[1000px] rounded-full bg-indigo-300/30 blur-3xl dark:bg-indigo-500/20"
            ></div>
            <div
                class="animate-blob animation-delay-4000 absolute top-1/2 left-1/2 h-[1000px] w-[1000px] rounded-full bg-sky-300/30 blur-3xl dark:bg-sky-500/20"
            ></div>
        </div>

        <Head title="Register" />

        <main class="relative z-10 flex min-h-screen flex-col items-center justify-center px-6 py-12 lg:px-8">
            <div class="mx-auto w-full max-w-md">
                <div
                    class="mb-8 transform text-center transition-all duration-1000"
                    :class="isVisible ? 'translate-y-0 opacity-100' : '-translate-y-4 opacity-0'"
                >
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Create your account</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Join us and start building something amazing</p>
                </div>

                <div
                    class="transform rounded-2xl border border-blue-100 bg-white/50 p-8 backdrop-blur-sm transition-all duration-1000 dark:border-blue-900 dark:bg-gray-900/50"
                    :class="contentVisible ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                >
                    <form @submit.prevent="submit" class="flex flex-col gap-6">
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label for="name">Name</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="name"
                                    v-model="form.name"
                                    placeholder="Full name"
                                    class="bg-white/80 dark:bg-gray-800/80"
                                />
                                <InputError :message="form.errors.name" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="email">Email address</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    :tabindex="2"
                                    autocomplete="email"
                                    v-model="form.email"
                                    placeholder="email@example.com"
                                    class="bg-white/80 dark:bg-gray-800/80"
                                />
                                <InputError :message="form.errors.email" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="password">Password</Label>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    :tabindex="3"
                                    autocomplete="new-password"
                                    v-model="form.password"
                                    placeholder="Password"
                                    class="bg-white/80 dark:bg-gray-800/80"
                                />
                                <InputError :message="form.errors.password" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="password_confirmation">Confirm password</Label>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    required
                                    :tabindex="4"
                                    autocomplete="new-password"
                                    v-model="form.password_confirmation"
                                    placeholder="Confirm password"
                                    class="bg-white/80 dark:bg-gray-800/80"
                                />
                                <InputError :message="form.errors.password_confirmation" />
                            </div>

                            <Button type="submit" class="mt-2 w-full bg-blue-600 hover:bg-blue-500" tabindex="5" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Create account
                            </Button>
                        </div>

                        <div class="text-muted-foreground text-center text-sm">
                            Already have an account?
                            <TextLink :href="loginCreate().url" :tabindex="6">Log in</TextLink>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

/* Add smooth transitions for all interactive elements */
a,
button {
    transition: all 0.3s ease;
}
</style>
