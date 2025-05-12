<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import { ref } from 'vue';

const props = defineProps<{
    contents?: any[];
}>();

// Créer un formulaire pour chaque contenu
const forms = ref(
    props.contents?.map((content) =>
        useForm({
            id: content.id,
            title: content.title,
            content: content.content,
        }),
    ) || [],
);

function submit(index: number) {
    const form = forms.value[index];
    form.put(route('admin.contents.update', form.id), {
        onSuccess: () => {
            // Potentiellement ajouter un feedback visuel ici
        },
    });
}
</script>

<template>
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="mb-6 text-2xl font-bold">Gestion du contenu</h1>

            <div v-for="(form, index) in forms" :key="form.id" class="mb-8 rounded-lg border bg-white p-6 shadow">
                <form @submit.prevent="submit(index)" class="space-y-4">
                    <div class="space-y-2">
                        <Label :for="`title-${form.id}`">Section</Label>
                        <p>{{ form.title }}</p>
                    </div>

                    <div class="space-y-2">
                        <Label :for="`content-${form.id}`">Contenu</Label>

                        <QuillEditor
                            toolbar="full"
                            v-model:content="form.content"
                            content-type="html"
                            :id="`content-${form.id}`"
                            theme="snow"
                            class="bg-white"
                        />

                        <p v-if="form.errors.content" class="mt-1 text-sm text-red-600">
                            {{ form.errors.content }}
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <Button type="submit" :disabled="form.processing"> Mettre à jour </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
