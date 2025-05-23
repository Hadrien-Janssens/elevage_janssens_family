<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/components/ui/carousel';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import heic2any from 'heic2any';
import { onMounted, ref } from 'vue';
import { Images } from '../../../types/index';

const props = defineProps({
    litter: Object,
    cats: Array,
    images: Array<Images> || [],
});

const form = useForm({
    name: props.litter?.name || '',
    birth_date: props.litter?.birth_date || '',
    mother_id: props.litter?.mother_id || '',
    father_id: props.litter?.father_id || '',
    description: props.litter?.description || '',
    photos: props.images?.map((image: Images) => image.image_path) || [],
    deleted_images: [] as number[],
    new_photos: [] as File[],
});

const existingImages = ref<Images[]>(props.images || []);
const newPhotoFiles = ref<File[]>([]);
const deletedImageIds = ref<number[]>([]);
const photoPreviews = ref<{ id?: number; src: string }[]>([]);

onMounted(() => {
    photoPreviews.value = existingImages.value.map((img) => ({
        id: img.id,
        src: '/' + img.image_path,
    }));
});

async function handlePhotoUpload(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file.type === 'image/heic' || file.name.endsWith('.heic')) {
                try {
                    const convertedBlob = await heic2any({ blob: file, toType: 'image/jpeg' });
                    const convertedFile = new File([convertedBlob as BlobPart], file.name.replace(/\.heic$/i, '.jpeg'), { type: 'image/jpeg' });
                    newPhotoFiles.value.push(convertedFile);
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreviews.value.push({ src: e.target?.result as string });
                    };
                    reader.readAsDataURL(convertedFile);
                } catch (error) {
                    console.error('Erreur de conversion HEIC :', error);
                }
            } else {
                newPhotoFiles.value.push(file);
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoPreviews.value.push({ src: e.target?.result as string });
                };
                reader.readAsDataURL(file);
            }
        }
    }
}

function removePhoto(index: number) {
    const item = photoPreviews.value[index];

    if (item.id) {
        deletedImageIds.value.push(item.id);
        existingImages.value = existingImages.value.filter((img) => img.id !== item.id);
    } else {
        const fileIndex = newPhotoFiles.value.findIndex((_, i) => i === index - existingImages.value.length);
        if (fileIndex !== -1) {
            newPhotoFiles.value.splice(fileIndex, 1);
        }
    }

    photoPreviews.value.splice(index, 1);
}

function submit() {
    form.deleted_images = deletedImageIds.value;
    form.new_photos = newPhotoFiles.value;

    form.post(route('admin.litters.update', props.litter?.id), {
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

                <div class="space-y-2">
                    <Label for="description">Description</Label>
                    <Textarea v-model="form.description" type="text" id="description" rows="4" />
                    <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="photos">Ajouter des photos</Label>
                    <Input type="file" id="photos" accept="image/*" multiple @change="handlePhotoUpload" />
                    <p v-if="form.errors.photos" class="mt-1 text-sm text-red-600">{{ form.errors.photos }}</p>
                </div>

                <div v-if="photoPreviews.length" class="mt-4">
                    <Carousel class="mx-auto w-full max-w-xl">
                        <CarouselContent>
                            <CarouselItem v-for="(item, index) in photoPreviews" :key="index" class="relative">
                                <img
                                    :src="item.src.startsWith('data:') ? item.src : '/storage/litters/' + item.src"
                                    class="h-64 w-full rounded-lg object-cover shadow"
                                />
                                <Button type="button" size="sm" class="absolute top-2 right-2 rounded-full font-black" @click="removePhoto(index)">
                                    supprimer
                                </Button>
                            </CarouselItem>
                        </CarouselContent>
                        <CarouselPrevious />
                        <CarouselNext />
                    </Carousel>
                </div>

                <Button type="submit" class="w-full">Mettre à jour</Button>
            </form>
            <form>
                <Button type="button" variant="outline" class="mt-4 w-full" @click="form.delete(route('admin.litters.destroy', props.litter?.id))">
                    Supprimer
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
