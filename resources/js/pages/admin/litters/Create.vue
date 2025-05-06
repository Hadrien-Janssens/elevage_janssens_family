<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/components/ui/carousel';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import heic2any from 'heic2any';
import { ref } from 'vue';

defineProps({
    cats: Array,
});

const form = useForm({
    name: '',
    birth_date: '',
    mother_id: '',
    father_id: '',
    photos: [],
});

const photoFiles = ref<File[]>([]);
const photoPreviews = ref<string[]>([]);

async function handlePhotoUpload(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file.type === 'image/heic' || file.name.endsWith('.heic')) {
                try {
                    const convertedBlob = await heic2any({ blob: file, toType: 'image/jpeg' });
                    const convertedFile = new File([convertedBlob as BlobPart], file.name.replace(/\.heic$/i, '.jpeg'), { type: 'image/jpeg' });
                    photoFiles.value.push(convertedFile);
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreviews.value.push(e.target?.result as string);
                    };
                    reader.readAsDataURL(convertedFile);
                } catch (error) {
                    console.error('Erreur de conversion HEIC :', error);
                }
            } else {
                photoFiles.value.push(file);
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoPreviews.value.push(e.target?.result as string);
                };
                reader.readAsDataURL(file);
            }
        }
    }
}

function removePhoto(index: number) {
    photoFiles.value.splice(index, 1);
    photoPreviews.value.splice(index, 1);
}

function submit() {
    form.photos = photoFiles.value;
    form.post(route('admin.litters.store'), {
        onSuccess: () => {
            photoFiles.value = [];
            photoPreviews.value = [];
            form.reset();
        },
    });
}
</script>

<template>
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="mb-6 text-2xl font-bold">Créer une portée</h1>
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

                <div class="space-y-2">
                    <Label for="photos">Photos</Label>
                    <Input type="file" id="photos" accept="image/*" multiple @change="handlePhotoUpload" />
                    <p v-if="form.errors.photos" class="mt-1 text-sm text-red-600">{{ form.errors.photos }}</p>
                </div>

                <div v-if="photoPreviews.length" class="mt-4">
                    <Carousel class="mx-auto w-full max-w-xl">
                        <CarouselContent>
                            <CarouselItem v-for="(src, index) in photoPreviews" :key="index" class="relative">
                                <img :src="src" class="h-64 w-full rounded-lg object-cover shadow" />
                                <Button type="button" variant="destructive" size="sm" class="absolute top-2 right-2" @click="removePhoto(index)">
                                    Supprimer
                                </Button>
                            </CarouselItem>
                        </CarouselContent>
                        <CarouselPrevious />
                        <CarouselNext />
                    </Carousel>
                </div>

                <Button type="submit" class="w-full">Créer</Button>
            </form>
        </div>
    </AppLayout>
</template>
