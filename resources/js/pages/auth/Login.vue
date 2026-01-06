<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head } from '@inertiajs/vue3';
import { useForm } from 'laravel-precognition-vue-inertia';
import { LoaderCircle } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import { store, create as loginCreate } from '@/actions/Laravel/Fortify/Http/Controllers/AuthenticatedSessionController';
import { create as registerCreate } from '@/actions/Laravel/Fortify/Http/Controllers/RegisteredUserController';
import { create as passwordRequestCreate } from '@/actions/Laravel/Fortify/Http/Controllers/PasswordResetLinkController';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm('post', store.url, {
    email: '',
    password: '',
    remember: false,
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

const submit = async () => {
    await form.submit();
    form.reset('password');
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

        <Head title="Log in" />

        <main class="relative z-10 flex min-h-screen flex-col items-center justify-center px-6 py-12 lg:px-8">
            <div class="mx-auto w-full max-w-md">
                <div
                    class="mb-8 transform text-center transition-all duration-1000"
                    :class="isVisible ? 'translate-y-0 opacity-100' : '-translate-y-4 opacity-0'"
                >
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Welcome back</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Enter your credentials to access your account</p>
                </div>

                <div
                    v-if="status"
                    class="mb-4 transform text-center text-sm font-medium text-green-600 transition-all duration-1000"
                    :class="isVisible ? 'translate-y-0 opacity-100' : '-translate-y-4 opacity-0'"
                >
                    {{ status }}
                </div>

                <div
                    class="transform rounded-2xl border border-blue-100 bg-white/50 p-8 backdrop-blur-sm transition-all duration-1000 dark:border-blue-900 dark:bg-gray-900/50"
                    :class="contentVisible ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                >
                    <form @submit.prevent="submit" class="flex flex-col gap-6">
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label for="email">Email address</Label>
                                <Input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="email"
                                    v-model="form.email"
                                    placeholder="email@example.com"
                                    @update:modelValue="form.validate('email')"
                                    class="bg-white/80 dark:bg-gray-800/80"
                                />
                                <InputError :message="form.errors.email" />
                            </div>

                            <div class="grid gap-2">
                                <div class="flex items-center justify-between">
                                    <Label for="password">Password</Label>
                                    <TextLink v-if="canResetPassword" :href="passwordRequestCreate().url" class="text-sm" :tabindex="5">
                                        Forgot password?
                                    </TextLink>
                                </div>
                                <Input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    :tabindex="2"
                                    autocomplete="current-password"
                                    v-model="form.password"
                                    placeholder="Password"
                                    @update:modelValue="form.validate('password')"
                                    class="bg-white/80 dark:bg-gray-800/80"
                                />
                                <InputError :message="form.errors.password" />
                            </div>

                            <div class="flex items-center justify-between">
                                <Label for="remember" class="flex items-center space-x-3">
                                    <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                                    <span>Remember me</span>
                                </Label>
                            </div>

                            <Button type="submit" class="mt-4 w-full bg-blue-600 hover:bg-blue-500" :tabindex="4" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Log in
                            </Button>
                        </div>

                        <div class="text-muted-foreground text-center text-sm">
                            Don't have an account?
                            <TextLink :href="registerCreate().url" :tabindex="5">Sign up</TextLink>
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
