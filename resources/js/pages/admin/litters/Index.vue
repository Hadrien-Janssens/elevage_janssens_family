<script lang="ts" setup>
import Button from '@/components/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Litter } from '../../../types/index';

defineProps<{
    litters: Litter[];
}>();
</script>
<template>
    <AppLayout>
        <div class="container">
            <div class="m-3 my-6">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="poetsone mb-3 text-3xl text-[#B5A9A4]">Mes portées</h2>
                    <Link :href="route('admin.litters.create')">
                        <Button label="Créer une portée" />
                    </Link>
                </div>
                <ul class="flex flex-col gap-3">
                    <li v-for="(litter, index) in litters" :key="index">
                        <Link :href="route('admin.litters.edit', litter?.id)" class="self-center">
                            <div class="flex w-full items-center justify-between rounded-2xl border p-5">
                                <p class="poetsone">
                                    {{ litter.name }}
                                </p>
                            </div>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
