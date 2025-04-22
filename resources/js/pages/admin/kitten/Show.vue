<script lang="ts" setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Cake } from 'lucide-vue-next';

defineProps({
    kitten: {
        type: Array,
        required: true,
    },
});
</script>
<template>
    <AppLayout>
        <div class="container">
            <div class="m-3 my-6">
                <figure class="h-64 w-full overflow-hidden rounded-lg bg-gray-200">
                    <img
                        v-if="kitten.images?.length"
                        :src="'/' + kitten.images[0].image_path"
                        alt="kitten"
                        class="h-full w-full object-cover object-center"
                    />
                </figure>

                <div class="flex items-center justify-between">
                    <h1 class="poetsone">
                        {{ kitten.name }}
                        <span class="text-xl font-bold" v-if="kitten.gender === 'Mâle'">♂</span>
                        <span class="text-xl font-bold" v-else>♀</span>
                    </h1>
                    <p class="flex items-center gap-2"><Cake /> né le {{ kitten.litter.birth_date }}</p>
                </div>
                <p>Description :</p>
                <p>{{ kitten.description }}</p>
                <p>Ma Maman : {{ kitten.litter.mother.name }}</p>
                <p>Mon Papa : {{ kitten.litter.father.name }}</p>
            </div>
        </div>
    </AppLayout>
</template>
