<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/components/ui/carousel';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import Switch from '@/components/ui/switch/Switch.vue';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import heic2any from 'heic2any';
import { onMounted, ref } from 'vue';
import { Images } from '../../../types/index';

const props = defineProps({
    kitten: Object,
    litters: Object,
    body_colors: Object,
    images: Array<Images> || [],
});

const form = useForm({
    name: props.kitten?.name || '',
    description: props.kitten?.description || '',
    gender: props.kitten?.gender || '',
    body_color_id: props.kitten?.body_color_id || '',
    litter_id: props.kitten?.litter_id || '',
    price: props.kitten?.price || '',
    is_booked: props.kitten?.is_booked || false,
    is_adopted: props.kitten?.is_adopted || false,
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
    console.log('deletedImageIds', deletedImageIds.value);
}

function submit() {
    // Utilisez Inertia.put directement
    form.deleted_images = deletedImageIds.value;
    form.new_photos = newPhotoFiles.value;

    form.post(route('admin.kitten.update', props.kitten.id), {
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
            <h1 class="mb-6 text-2xl font-bold">Édition d'un chaton</h1>
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
                    <Label>Couleur</Label>
                    <Select v-model="form.body_color_id" class="w-full">
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="Choisis une couleur" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem v-for="body_color in body_colors" :key="body_color.id" :value="body_color.id">
                                    {{ body_color.name }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <p v-if="form.errors.body_color_id" class="mt-1 text-sm text-red-600">{{ form.errors.body_color_id }}</p>
                </div>

                <div class="space-y-2">
                    <Label>Portée</Label>
                    <Select v-model="form.litter_id" class="w-full">
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="Choisis une portée" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem v-for="litter in litters" :key="litter.id" :value="litter.id">
                                    {{ litter.name }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <p v-if="form.errors.litter_id" class="mt-1 text-sm text-red-600">{{ form.errors.litter_id }}</p>
                </div>

                <div class="space-y-2">
                    <Label for="price">Prix</Label>
                    <Input v-model="form.price" type="number" id="price" />
                    <p v-if="form.errors.price" class="mt-1 text-sm text-red-600">{{ form.errors.price }}</p>
                </div>

                <div class="flex items-center space-x-2">
                    <Switch v-model="form.is_booked" id="is_booked" />
                    <Label for="is_booked">Réservé</Label>
                </div>

                <div class="flex items-center space-x-2">
                    <Switch v-model="form.is_adopted" id="is_adopted" />
                    <Label for="is_adopted">Adopté</Label>
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
                                <img :src="item.src" class="h-64 w-full rounded-lg object-cover shadow" />
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
                <Button type="button" variant="outline" class="mt-4 w-full" @click="form.delete(route('admin.kitten.destroy', props.kitten?.id))">
                    Supprimer
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
