<script lang="ts" setup>
import Button from '@/components/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    cats: {
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
                    <h2 class="poetsone mb-3 text-3xl text-[#B5A9A4]">Mes chats</h2>
                    <Link :href="route('admin.cats.create')">
                        <Button label="Ajouter un chat" />
                    </Link>
                </div>
                <ul class="flex flex-col gap-3">
                    <li v-for="(cat, index) in cats" :key="index">
                        <Link :href="route('admin.cats.edit', cat?.id)" class="self-center">
                            <div class="flex w-full items-center justify-between rounded-2xl border p-5">
                                <p class="poetsone">
                                    {{ cat.name }}
                                </p>
                            </div>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
