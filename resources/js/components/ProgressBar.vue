<script setup lang="ts">
import { Check } from 'lucide-vue-next';

defineProps<{
    current: number;
    total: number;
    progress: number;
    isProcessing: boolean;
    isComplete: boolean;
}>();
</script>

<template>
    <div v-if="isProcessing || isComplete" class="space-y-2">
        <div class="relative h-2 w-full rounded bg-gray-200">
            <div class="absolute h-full rounded bg-blue-500 transition-all duration-300" :style="{ width: `${progress}%` }"></div>
        </div>
        <p v-if="isProcessing" class="text-sm text-gray-600">{{ current }} / {{ total }} images traitées</p>
        <p v-if="isComplete" class="flex items-center gap-2 text-sm text-gray-600"><Check class="h-4 w-4 text-green-600" /> Traitement terminé</p>
    </div>
</template>
