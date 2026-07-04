<script lang="ts" setup>
import ProgressBar from '@/components/ProgressBar.vue';
import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import Switch from '@/components/ui/switch/Switch.vue';
import { Textarea } from '@/components/ui/textarea';
import { useImageHandler } from '@/composables/useImageHandler';
import { useProgress } from '@/composables/useProgress';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import draggable from 'vuedraggable';
import { Images } from '../../../types/index';

const drag = ref(false);

const props = defineProps({
    kitten: Object,
    litters: Object,
    images: Array<Images> || [],
});

const form = useForm({
    name: props.kitten?.name || '',
    description: props.kitten?.description || '',
    gender: props.kitten?.gender || '',
    race: props.kitten?.race,
    body_color: props.kitten?.body_color || '',
    litter_id: props.kitten?.litter_id || '',
    price: props.kitten?.price || '',
    is_booked: props.kitten?.is_booked || false,
    is_adopted: props.kitten?.is_adopted || false,
    new_photos: [] as File[],
    new_videos: [] as File[],
    media_order: [] as string[],
    deleted_media: [] as number[],
});

interface MediaItem {
    id?: number;
    src: string;
    file?: File;
    type: 'existing' | 'new_photo' | 'new_video';
    is_video: boolean;
}

const mediaItems = ref<MediaItem[]>([]);
const existingImages = ref<any[]>([]);

onMounted(() => {
    if (props.images) {
        mediaItems.value = props.images.map((img: Images) => ({
            id: img.id,
            src: img.image_path,
            type: 'existing',
            is_video: img.is_video,
        }));
    }
});

const { addPhoto } = useImageHandler(existingImages, mediaItems as any);
const { progress, totalItems, currentItem, isProcessing, isComplete, startProcessing, updateProgress, completeProcessing } = useProgress();

async function handlePhotoUpload(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (!files) return;

    startProcessing(files.length);

    for (let i = 0; i < files.length; i++) {
        const processedFile = await addPhoto(files[i]);
        if (processedFile) {
            const lastItem = mediaItems.value[mediaItems.value.length - 1];
            lastItem.type = 'new_photo';
            lastItem.file = processedFile;
            lastItem.is_video = false;
        }
        updateProgress();
    }

    completeProcessing();
    (event.target as HTMLInputElement).value = ''; // Reset input
}

async function handleVideoUpload(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (!files) return;

    startProcessing(files.length);

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (!file.type.startsWith('video/')) continue;

        const preview = URL.createObjectURL(file);
        mediaItems.value.push({
            src: preview,
            file: file,
            type: 'new_video',
            is_video: true,
        });

        updateProgress();
    }

    completeProcessing();
    (event.target as HTMLInputElement).value = ''; // Reset input
}

function removeMedia(index: number) {
    const item = mediaItems.value[index];
    if (item.type === 'existing' && item.id) {
        form.deleted_media.push(item.id);
    }
    mediaItems.value.splice(index, 1);
}

function submit() {
    form.new_photos = mediaItems.value.filter(m => m.type === 'new_photo').map(m => m.file as File);
    form.new_videos = mediaItems.value.filter(m => m.type === 'new_video').map(m => m.file as File);
    
    let photoIndex = 0;
    let videoIndex = 0;
    
    form.media_order = mediaItems.value.map(item => {
        if (item.type === 'new_photo') {
            return `new_photo:${photoIndex++}`;
        } else if (item.type === 'new_video') {
            return `new_video:${videoIndex++}`;
        }
        return `existing:${item.id}`;
    });

    form.post(route('admin.kitten.update', { kitten: props.kitten?.id }), {
        forceFormData: true,
        onSuccess: () => {
            form.deleted_media = [];
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
                    <Label for="photos">Ajouter des photos</Label>
                    <Input type="file" id="photos" accept="image/*" multiple @change="handlePhotoUpload" />
                    <p v-if="form.errors.new_photos" class="mt-1 text-sm text-red-600">{{ form.errors.new_photos }}</p>
                </div>
                
                <div class="space-y-2">
                    <Label for="videos">Ajouter des vidéos</Label>
                    <Input type="file" id="videos" accept="video/*" multiple @change="handleVideoUpload" />
                    <p v-if="form.errors.new_videos" class="mt-1 text-sm text-red-600">{{ form.errors.new_videos }}</p>
                </div>

                <ProgressBar
                    :current="currentItem"
                    :total="totalItems"
                    :progress="progress"
                    :is-processing="isProcessing"
                    :is-complete="isComplete"
                />

                <p v-if="form.errors.deleted_media" class="mt-1 text-sm text-red-600">{{ form.errors.deleted_media }}</p>

                <div v-if="mediaItems.length" class="mt-4">
                    <p class="mb-2 text-sm text-gray-500">Glissez-déposez pour réorganiser l'ordre d'affichage des médias.</p>
                    <draggable v-model="mediaItems" item-key="src" class="flex flex-wrap gap-4" @start="drag = true" @end="drag = false">
                        <template #item="{ element, index }">
                            <div class="relative w-48 h-64 border rounded-lg overflow-hidden bg-gray-100 shadow flex items-center justify-center">
                                <div class="absolute top-2 left-2 bg-black/50 text-white text-xs px-2 py-1 rounded-full z-10">
                                    {{ index + 1 }}
                                </div>

                                <video v-if="element.is_video" :src="element.src.startsWith('data:') || element.src.startsWith('blob:') ? element.src : '/storage/kittens/' + element.src" class="h-full w-full object-cover" controls></video>
                                <img v-else :src="element.src.startsWith('data:') || element.src.startsWith('blob:') ? element.src : '/storage/kittens/' + element.src" class="h-full w-full object-cover" />
                                
                                <Button type="button" variant="destructive" size="sm" class="absolute top-2 right-2 z-10" @click="removeMedia(index)">
                                    X
                                </Button>
                            </div>
                        </template>
                    </draggable>
                </div>
                <Button type="submit" class="w-full" :disabled="isProcessing">Mettre à jour</Button>
            </form>

            <form>
                <Button
                    type="button"
                    variant="outline"
                    class="mt-4 w-full"
                    @click="form.delete(route('admin.kitten.destroy', { kitten: props.kitten?.id }))"
                >
                    Supprimer
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
