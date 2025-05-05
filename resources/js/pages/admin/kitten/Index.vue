<script lang="ts" setup>
import Button from '@/components/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    kittens: {
        type: Array,
        required: true,
    },
});
</script>
<template>
    <AppLayout>
        <div class="container">
            <div class="m-3 my-6">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="poetsone mb-3 text-3xl text-[#B5A9A4]">Mes chatons</h2>
                    <Link :href="route('admin.kitten.create')">
                        <Button label="Créer un chaton" />
                    </Link>
                </div>
                <ul class="flex flex-col gap-3">
                    <li v-for="(kitten, index) in kittens" :key="index">
                        <Link :href="route('admin.kitten.edit', kitten)" class="self-center">
                            <div class="flex w-full items-center justify-between rounded-2xl border p-5">
                                <p class="poetsone">
                                    {{ kitten.name }}
                                </p>
                            </div>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
