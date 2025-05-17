<script setup lang="ts">
import Heading from '@/components/Heading.vue';


</script>

<template>
    <div class="px-4 py-6">
        <Heading title="Users" description="Manage your profile and account settings" />
        <div class="flex-1 md:max-w-2xl lg:max-w-none w-full">
            <section class="max- space-y-12">
                <slot />
            </section>
        </div>
        
    </div>
</template>
