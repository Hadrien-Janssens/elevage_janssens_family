<script setup lang="ts">
import Button from '@/components/Button.vue';
import { Button as uiButton } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    faqs: Object,
});

// Créer un formulaire pour chaque contenu
const forms = ref(
    props.faqs?.map((faq) =>
        useForm({
            id: faq.id,
            question: faq.question,
            answer: faq.answer,
        }),
    ) || [],
);

function submit(index: number) {
    const form = forms.value[index];
    form.put(route('admin.faq.update', form.id), {
        onSuccess: () => {
            // Potentiellement ajouter un feedback visuel ici
        },
    });
}
</script>

<template>
    <AppLayout>
        <div class="container">
            <div class="m-3 my-6">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="poetsone mb-3 text-3xl text-[#B5A9A4]">FAQ</h2>
                    <Link :href="route('admin.faq.create')">
                        <Button label="Créer une question" />
                    </Link>
                </div>
                <form
                    v-for="(form, index) in forms"
                    :key="index"
                    class="mb-8 space-y-1 rounded-lg border bg-white p-6 shadow"
                    @submit.prevent="submit(index)"
                >
                    <p>{{ form.question }}</p>
                    <QuillEditor
                        toolbar="full"
                        v-model:content="form.answer"
                        content-type="html"
                        :id="`content-${form.id}`"
                        theme="snow"
                        class="bg-white"
                    />

                    <uiButton type="submit">Modifier</uiButton>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
