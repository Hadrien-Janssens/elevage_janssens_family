<script lang="ts" setup>
import ProgressBar from '@/components/ProgressBar.vue';
import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import Switch from '@/components/ui/switch/Switch.vue';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import draggable from 'vuedraggable';
import { useImageHandler } from '../../../composables/useImageHandler';
import { useProgress } from '../../../composables/useProgress';

// état du drag
const drag = ref(false);

defineProps({
    litters: Object,
});

const form = useForm({
    name: 'test',
    description: 'test',
    gender: 'Femelle',
    race: 'test',
    body_color: 'test',
    litter_id: '2',
    price: '200',
    is_booked: false,
    is_adopted: false,
    photos: [],
    videos: [],
    orders_photo: [],
});
const photoFiles = ref<object[]>([]);
const photoPreviews = ref<{ id?: number; src: string; order: number }[]>([]);
const existingImages = ref<{ id?: number; src: string }[]>([]);
const videoFiles = ref<File[]>([]);
const videoPreviews = ref<{ src: string }[]>([]);
async function handleVideoUpload(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (!files) return;

    startProcessing(files.length);
    videoFiles.value = [];

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (!file.type.startsWith('video/')) continue; // ignore si ce n'est pas une vidéo

        const preview = URL.createObjectURL(file);
        videoPreviews.value.push({ src: preview });
        videoFiles.value.push(file);

        updateProgress();
    }

    completeProcessing();
}

function removeVideo(index: number) {
    videoFiles.value.splice(index, 1);
    videoPreviews.value.splice(index, 1);
}

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
        // const preview = await generatePreview(processedFile);
        // photoPreviews.value.push({ src: preview });

        //ajouter un ordre au preview
        photoPreviews.value[i].order = i;

        if (processedFile) {
            photoFiles.value.push(processedFile);
        }

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
    console.log(photoPreviews.value);
    return;
    // form.orders_photo = photoFiles.value.map((p) => p.order);
    // form.orders_photo = photoPreviews.map((el,index) => )
    form.videos = videoFiles.value;
    form.post(route('admin.kitten.store'), {
        forceFormData: true,
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
            <h1 class="mb-6 text-2xl font-bold">Ajout d'un chaton</h1>
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

                <div class="space-y-2">
                    <Label for="videos">Vidéos</Label>
                    <Input type="file" id="videos" accept="video/*" multiple @change="handleVideoUpload" />
                    <p v-if="form.errors.videos" class="mt-1 text-sm text-red-600">{{ form.errors.videos }}</p>
                </div>
                <ProgressBar
                    :current="currentItem"
                    :total="totalItems"
                    :progress="progress"
                    :is-processing="isProcessing"
                    :is-complete="isComplete"
                />

                <div v-if="videoPreviews.length" class="mt-4 space-y-4">
                    <div v-for="(vid, index) in videoPreviews" :key="index" class="relative">
                        <video :src="vid.src" class="w-full rounded-lg shadow" controls></video>
                        <Button type="button" variant="destructive" size="sm" class="absolute top-2 right-2" @click="removeVideo(index)">
                            Supprimer
                        </Button>
                    </div>
                </div>

                <div v-if="photoPreviews.length" class="mt-4">
                    <!-- <Carousel class="mx-auto w-full max-w-xl">
                        <CarouselContent class="w-3/4">
                            <CarouselItem v-for="(src, index) in photoPreviews" :key="index" class="relative">
                                <img :src="src.src" class="h-64 w-full rounded-lg object-cover shadow" />
                                <Button type="button" variant="destructive" size="sm" class="absolute top-2 right-2" @click="removePhoto(index)">
                                    Supprimer
                                </Button>
                            </CarouselItem>
                        </CarouselContent>
                    </Carousel> -->
                    <draggable v-model="photoPreviews" item-key="id" class="flex gap-4" @start="drag = true" @end="drag = false">
                        <template #item="{ element, index }">
                            <div class="relative">
                                <p>{{ index }}</p>

                                <img
                                    :src="element.src.startsWith('data:') ? element.src : '/storage/kittens/' + element.src"
                                    class="h-64 w-48 rounded-lg object-cover shadow"
                                />
                                <Button type="button" size="sm" class="absolute top-2 right-2 rounded-full font-black" @click="removePhoto(index)">
                                    supprimer
                                </Button>
                            </div>
                        </template>
                    </draggable>
                </div>

                <Button type="submit" :disabled="isProcessing" class="w-full">Enregistrer</Button>
            </form>
        </div>
    </AppLayout>
</template>
