<script lang="ts" setup>
import ProgressBar from '@/components/ProgressBar.vue';
import { Button } from '@/components/ui/button';
import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import { useImageHandler } from '@/composables/useImageHandler';
import { useProgress } from '@/composables/useProgress';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { Images } from '../../../types/index';

const props = defineProps({
    cat: Object,
    images: Array<Images> || [],
});

const form = useForm({
    name: props.cat?.name || '',
    description: props.cat?.description || '',
    gender: props.cat?.gender || '',
    race: props.cat?.race || '',
    birthday: props.cat?.birthday || '',
    body_color: props.cat?.body_color || '',
    photos: props.images?.map((image: Images) => image.image_path) || [],
    deleted_images: [] as number[],
    new_photos: [] as File[],
});

const existingImages = ref<Images[]>(props.images || []);
const newPhotoFiles = ref<File[]>([]);
const deletedImageIds = ref<number[]>([]);
const photoPreviews = ref<{ id?: number; src: string }[]>([]);

// Initialisation des prévisualisations
onMounted(() => {
    photoPreviews.value = existingImages.value.map((img) => ({
        id: img.id,
        src: '/' + img.image_path,
    }));
});

const { addPhoto } = useImageHandler(existingImages, photoPreviews);
const { progress, totalItems, currentItem, isProcessing, isComplete, startProcessing, updateProgress, completeProcessing } = useProgress();

// Gestion des uploads
async function handlePhotoUpload(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (!files) return;

    startProcessing(files.length);
    newPhotoFiles.value = [];

    for (let i = 0; i < files.length; i++) {
        const processedFile = await addPhoto(files[i]);
        if (processedFile) newPhotoFiles.value.push(processedFile);
        updateProgress();
    }

    completeProcessing();
}

function removePhoto(index: number) {
    const item = photoPreviews.value[index];

    if (item.id) {
        // Suppression d'une image existante
        deletedImageIds.value.push(item.id);
        existingImages.value = existingImages.value.filter((img) => img.id !== item.id);
    } else {
        // Suppression d'une nouvelle image
        const fileIndex = newPhotoFiles.value.findIndex((_, i) => i === index - existingImages.value.length);
        if (fileIndex !== -1) {
            newPhotoFiles.value.splice(fileIndex, 1);
        }
    }

    photoPreviews.value.splice(index, 1);
}

function submit() {
    // Utilisez Inertia.put directement
    form.deleted_images = deletedImageIds.value;
    form.new_photos = newPhotoFiles.value;

    form.post(route('admin.cats.update', props.cat?.id), {
        onSuccess: () => {
            newPhotoFiles.value = [];
            deletedImageIds.value = [];
        },
    });
}
</script>

<template>
    <AppLayout>
        <div class="container mx-auto p-6">
            <h1 class="mb-6 text-2xl font-bold">Édition d'un chat</h1>
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
                    <Label for="body_color">Race</Label>
                    <Input v-model="form.race" type="text" id="race" />
                    <p v-if="form.errors.race" class="mt-1 text-sm text-red-600">{{ form.errors.race }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="body_color">Couleur</Label>
                    <Input v-model="form.body_color" type="text" id="body_color" />
                    <p v-if="form.errors.body_color" class="mt-1 text-sm text-red-600">{{ form.errors.body_color }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="photos">Ajouter des photos</Label>
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
                <p v-if="form.errors.new_photos" class="mt-1 text-sm text-red-600">{{ form.errors.new_photos }}</p>
                <p v-if="form.errors.deleted_images" class="mt-1 text-sm text-red-600">{{ form.errors.deleted_images }}</p>

                <div v-if="photoPreviews.length" class="mt-4">
                    <Carousel class="mx-auto w-full max-w-xl">
                        <CarouselContent class="w-3/4">
                            <CarouselItem v-for="(item, index) in photoPreviews" :key="index" class="relative">
                                <img
                                    :src="item.src.startsWith('data:') ? item.src : '/storage/cats/' + item.src"
                                    class="h-64 w-full rounded-lg object-cover shadow"
                                />
                                <Button type="button" size="sm" class="absolute top-2 right-2 rounded-full font-black" @click="removePhoto(index)">
                                    supprimer
                                </Button>
                            </CarouselItem>
                        </CarouselContent>
                    </Carousel>
                </div>

                <Button type="submit" class="w-full" :disabled="isProcessing">Mettre à jour</Button>
            </form>

            <form>
                <Button type="button" variant="outline" class="mt-4 w-full" @click="form.delete(route('admin.cats.destroy', props.cat?.id))">
                    Supprimer
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
