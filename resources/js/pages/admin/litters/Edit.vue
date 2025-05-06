<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    litter: Object,
    cats: Array,
    kittens: Array,
});

const form = useForm({
    name: props.litter.name || '',
    birth_date: props.litter.birth_date || '',
    mother_id: props.litter.mother_id || '',
    father_id: props.litter.father_id || '',
});

function submit() {
    form.put(route('admin.litters.update', props.litter.id), {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="mb-6 text-2xl font-bold">Modifier une portée</h1>
            <form @submit.prevent="submit" class="space-y-6">
                <div class="space-y-2">
                    <Label for="name">Nom</Label>
                    <Input v-model="form.name" type="text" id="name" />
                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="birth_date">Date de naissance</Label>
                    <Input v-model="form.birth_date" type="date" id="birth_date" />
                    <p v-if="form.errors.birth_date" class="mt-1 text-sm text-red-600">{{ form.errors.birth_date }}</p>
                </div>

                <div class="space-y-2">
                    <Label>Mère</Label>
                    <select v-model="form.mother_id" class="w-full rounded border">
                        <option value="">Aucune</option>
                        <option v-for="cat in cats" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                    </select>
                    <p v-if="form.errors.mother_id" class="mt-1 text-sm text-red-600">{{ form.errors.mother_id }}</p>
                </div>

                <div class="space-y-2">
                    <Label>Père</Label>
                    <select v-model="form.father_id" class="w-full rounded border">
                        <option value="">Aucun</option>
                        <option v-for="cat in cats" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                    </select>
                    <p v-if="form.errors.father_id" class="mt-1 text-sm text-red-600">{{ form.errors.father_id }}</p>
                </div>

                <Button type="submit" class="w-full">Mettre à jour</Button>
            </form>
        </div>
    </AppLayout>
</template>
