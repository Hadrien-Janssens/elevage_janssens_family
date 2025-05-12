<script lang="ts" setup>
import ProgressBar from '@/components/ProgressBar.vue';
import { Button } from '@/components/ui/button';
import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useImageHandler } from '../../../composables/useImageHandler';
import { useProgress } from '../../../composables/useProgress';

const form = useForm({
    name: '',
    description: '',
    gender: '',
    body_color: '',
    birthday: '',
    race: '',
    photos: [],
});

const photoFiles = ref<File[]>([]);
const photoPreviews = ref<{ id?: number; src: string }[]>([]);
const existingImages = ref<{ id?: number; src: string }[]>([]);

const { addPhoto } = useImageHandler(existingImages, photoPreviews);
const { progress, totalItems, currentItem, isProcessing, isComplete, startProcessing, updateProgress, completeProcessing } = useProgress();

// Gestion des uploads
async function handlePhotoUpload(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (!files) return;

    startProcessing(files.length);
    photoFiles.value = [];

    for (let i = 0; i < files.length; i++) {
        const processedFile = await addPhoto(files[i]);
        if (processedFile) photoFiles.value.push(processedFile);

        updateProgress();
    }

    completeProcessing();
}

function removePhoto(index: number) {
    photoFiles.value.splice(index, 1);
    photoPreviews.value.splice(index, 1);
}

function submit() {
    form.photos = photoFiles.value;
    form.post(route('admin.cats.store'), {
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
            <h1 class="mb-6 text-2xl font-bold">Ajout d'un chat</h1>
            <form @submit.prevent="submit" class="space-y-6">
                <div class="space-y-2">
                    <Label for="name">Nom</Label>
                    <Input v-model="form.name" type="text" id="name" />
                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="description">Description</Label>
                    <Textarea v-model="form.description" id="description" class="resize-none" />
                    <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
                </div>

                <div class="space-y-2">
                    <Label>Genre</Label>
                    <Select v-model="form.gender" class="w-full">
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="Choisis un genre" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem value="Mâle">Mâle</SelectItem>
                                <SelectItem value="Femelle">Femelle</SelectItem>
                                <SelectItem value="Indéfini">Pas encore défini</SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <p v-if="form.errors.gender" class="mt-1 text-sm text-red-600">{{ form.errors.gender }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="birthday">Date de naissance</Label>
                    <Input v-model="form.birthday" type="date" id="birthday" />
                    <p v-if="form.errors.birthday" class="mt-1 text-sm text-red-600">{{ form.errors.birthday }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="race">Race</Label>
                    <Input type="text " id="race" v-model="form.race" />
                    <p v-if="form.errors.race" class="mt-1 text-sm text-red-600">{{ form.errors.race }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="body_color">Couleur</Label>
                    <Input type="text " id="body_color" v-model="form.body_color" />
                    <p v-if="form.errors.body_color" class="mt-1 text-sm text-red-600">{{ form.errors.body_color }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="photos">Photos</Label>
                    <Input type="file" id="photos" accept="image/*" multiple @change="handlePhotoUpload" />
                    <p v-if="form.errors.photos" class="mt-1 text-sm text-red-600">{{ form.errors.photos }}</p>
                </div>
                <ProgressBar
                    :current="currentItem"
                    :total="totalItems"
                    :progress="progress"
                    :is-processing="isProcessing"
                    :is-complete="isComplete"
                />

                <div v-if="photoPreviews.length" class="mt-4">
                    <Carousel class="mx-auto w-full max-w-xl">
                        <CarouselContent class="w-3/4">
                            <CarouselItem v-for="(src, index) in photoPreviews" :key="index" class="relative">
                                <img :src="src.src" class="h-64 w-full rounded-lg object-cover shadow" />
                                <Button type="button" variant="destructive" size="sm" class="absolute top-2 right-2" @click="removePhoto(index)">
                                    Supprimer
                                </Button>
                            </CarouselItem>
                        </CarouselContent>
                    </Carousel>
                </div>

                <Button type="submit" class="w-full" :disable="isProcessing">Enregistrer</Button>
            </form>
        </div>
    </AppLayout>
</template>
