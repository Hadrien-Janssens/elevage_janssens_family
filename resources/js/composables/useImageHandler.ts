import heic2any from 'heic2any';
import { Ref } from 'vue';

export const useImageHandler = (existingImages: Ref<any[]>, photoPreviews: Ref<any[]>) => {
    const processHEICFile = async (file: File) => {
        try {
            const convertedBlob = await heic2any({ blob: file, toType: 'image/jpeg' });
            return new File([convertedBlob as BlobPart], file.name.replace(/\.heic$/i, '.jpeg'), {
                type: 'image/jpeg',
            });
        } catch (error) {
            console.error('HEIC conversion error:', error);
            return null;
        }
    };

    const generatePreview = (file: File): Promise<string> => {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = (e) => resolve(e.target?.result as string);
            reader.readAsDataURL(file);
        });
    };

    const addPhoto = async (file: File) => {
        const processedFile = file.type === 'image/heic' || file.name.endsWith('.heic') ? await processHEICFile(file) : file;

        if (!processedFile) return;

        const preview = await generatePreview(processedFile);
        photoPreviews.value.push({ src: preview });

        return processedFile;
    };

    return { addPhoto };
};
