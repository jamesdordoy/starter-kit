<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { Button } from '@/components/ui/button';
import { ArrowRight, Github, BookOpen } from 'lucide-vue-next';

// Animation states
const isVisible = ref(false);
const contentVisible = ref(false);
const page = usePage();

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
        setTimeout(() => {
            contentVisible.value = true;
        }, 500);
    }, 100);
});
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="relative min-h-screen overflow-hidden bg-gradient-to-b from-blue-50 to-white dark:from-blue-950 dark:to-gray-950">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -left-1/2 -top-1/2 h-[1000px] w-[1000px] animate-blob rounded-full bg-blue-300/30 blur-3xl dark:bg-blue-500/20"></div>
            <div class="absolute -right-1/2 -bottom-1/2 h-[1000px] w-[1000px] animate-blob animation-delay-2000 rounded-full bg-indigo-300/30 blur-3xl dark:bg-indigo-500/20"></div>
            <div class="absolute left-1/2 top-1/2 h-[1000px] w-[1000px] animate-blob animation-delay-4000 rounded-full bg-sky-300/30 blur-3xl dark:bg-sky-500/20"></div>
        </div>

        <!-- Navigation -->
        <header class="relative z-10 w-full border-b border-blue-100 bg-white/80 backdrop-blur-md dark:border-blue-900 dark:bg-gray-900/80">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-blue-600 dark:text-blue-400">Starter Kit</span>
                </div>
                <nav class="flex items-center gap-4">
                    <Link
                        v-if="page.props.auth.user"
                        :href="route('dashboard')"
                        class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all duration-300"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="inline-flex items-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-blue-600 shadow-sm ring-1 ring-inset ring-blue-300 hover:bg-blue-50 transition-all duration-300 dark:bg-gray-800 dark:text-blue-400 dark:ring-blue-700 dark:hover:bg-gray-700"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="route('register')"
                            class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all duration-300"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </div>
        </header>

        <!-- Main content -->
        <main class="relative z-10 flex min-h-[calc(100vh-4rem)] flex-col items-center justify-center px-6 py-12 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <!-- Hero text -->
                <h1 
                    class="text-4xl font-bold tracking-tight text-blue-300 dark:text-white sm:text-6xl transform transition-all duration-1000"
                    :class="isVisible ? 'translate-y-0 opacity-100' : '-translate-y-4 opacity-0'"
                >
                    Ready to build
                    <span 
                        class="block text-blue-600 dark:text-blue-400 transform transition-all duration-1000 delay-300"
                        :class="isVisible ? 'translate-y-0 opacity-100' : '-translate-y-4 opacity-0'"
                    >
                        something great?
                    </span>
                </h1>
                
                <p 
                    class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300 transform transition-all duration-1000 delay-500"
                    :class="isVisible ? 'translate-y-0 opacity-100' : '-translate-y-4 opacity-0'"
                >
                    A beautiful starter kit for your next project. Built with Laravel, Vue, and Tailwind CSS.
                </p>

                <!-- CTA Buttons -->
                <div 
                    class="mt-10 flex items-center justify-center gap-x-6 transform transition-all duration-1000 delay-700"
                    :class="isVisible ? 'translate-y-0 opacity-100' : '-translate-y-4 opacity-0'"
                >
                    <Link :href="route('register')">
                        <Button size="lg" class="group bg-blue-600 hover:bg-blue-500">
                            Get started
                            <ArrowRight class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1" />
                        </Button>
                    </Link>
                    <Link :href="route('login')">
                        <Button variant="outline" size="lg" class="border-blue-200 text-blue-600 hover:bg-blue-50 dark:border-blue-800 dark:text-blue-400 dark:hover:bg-gray-800">
                            Sign in
                        </Button>
                    </Link>
                </div>

                <!-- Features -->
                <div 
                    class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 transform transition-all duration-1000 delay-1000"
                    :class="contentVisible ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                >
                    <div class="rounded-2xl border border-blue-100 bg-white/50 p-6 backdrop-blur-sm dark:border-blue-900 dark:bg-gray-900/50">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400">
                            <Github class="h-6 w-6" />
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Open Source</h3>
                        <p class="text-gray-600 dark:text-gray-300">Built with best in slot packages and best practices for experianced Laravel devs.</p>
                    </div>

                    <div class="rounded-2xl border border-blue-100 bg-white/50 p-6 backdrop-blur-sm dark:border-blue-900 dark:bg-gray-900/50">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400">
                            <BookOpen class="h-6 w-6" />
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Built around Spaite and Intertia</h3>
                        <p class="text-gray-600 dark:text-gray-300">Best packages for each and every job.</p>
                    </div>
                    

                    <div class="rounded-2xl border border-blue-100 bg-white/50 p-6 backdrop-blur-sm dark:border-blue-900 dark:bg-gray-900/50">
                        <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Super Modern Stack</h3>
                        <p class="text-gray-600 dark:text-gray-300">Laravel, Vue 3, TypeScript, Inertia.js, Ton of Spatie packages and Tailwind CSS.</p>
                    </div>
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
a, button {
    transition: all 0.3s ease;
}

/* Add hover effects */
.rounded-2xl {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.rounded-2xl:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
}

/* Add animation to the logo */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-5px);
    }
    100% {
        transform: translateY(0px);
    }
}

.text-xl {
    animation: float 3s ease-in-out infinite;
}
</style>
