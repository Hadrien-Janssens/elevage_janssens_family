<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';

import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    question: '',
    answer: '',
});

function submit() {
    form.post(route('admin.faq.store'), {
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>
<template>
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="mb-6 text-2xl font-bold">Ajouter une question</h1>

            <form @submit.prevent="submit" class="space-y-6">
                <div class="space-y-2">
                    <Label for="name">Question</Label>
                    <Input v-model="form.question" type="text" id="name" />
                    <p v-if="form.errors.question" class="mt-1 text-sm text-red-600">{{ form.errors.question }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="description">Réponse</Label>
                    <Textarea v-model="form.answer" id="description" class="resize-none" />
                    <p v-if="form.errors.answer" class="mt-1 text-sm text-red-600">{{ form.errors.answer }}</p>
                </div>
                <Button type="submit" class="w-full">Enregistrer</Button>
            </form>
        </div>
    </AppLayout>
</template>
