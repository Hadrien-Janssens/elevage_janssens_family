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
                <div class="flex items-center justify-between">
                    <h2 class="poetsone mb-3 text-3xl text-[#B5A9A4]">Mes chatons</h2>
                    <Link :href="route('admin.kitten.create')">
                        <Button label="Créer un chaton" />
                    </Link>
                </div>
                <ul class="flex flex-col gap-3">
                    <li v-for="(kitten, index) in kittens" :key="index" class="relative">
                        <figure class="h-64 w-full overflow-hidden rounded-lg bg-gray-200">
                            <img
                                v-if="kitten.images?.length"
                                :src="'/' + kitten.images[0].image_path"
                                alt="kitten"
                                class="h-full w-full object-cover object-center"
                            />
                        </figure>
                        <div class="absolute bottom-0 flex w-full items-center justify-between rounded-b-lg bg-[#CDC6C2AA] p-3">
                            <p class="poetsone">
                                {{ kitten.name }}
                                <span class="text-xl font-bold" v-if="kitten.gender === 'Mâle'">♂</span>
                                <span class="text-xl font-bold" v-else>♀</span>
                            </p>

                            <Link :href="route('admin.kitten.show', kitten)" class="self-center">
                                <Button label="Voir plus" />
                            </Link>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
