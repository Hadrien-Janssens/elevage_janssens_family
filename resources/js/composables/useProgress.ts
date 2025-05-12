import { ref } from 'vue';

export const useProgress = () => {
    const progress = ref(0);
    const totalItems = ref(0);
    const currentItem = ref(0);
    const isProcessing = ref(false);
    const isComplete = ref(false);

    const startProcessing = (total: number) => {
        totalItems.value = total;
        currentItem.value = 0;
        isProcessing.value = true;
        isComplete.value = false;
    };

    const updateProgress = () => {
        currentItem.value++;
        progress.value = (currentItem.value / totalItems.value) * 100;
    };

    const completeProcessing = () => {
        isProcessing.value = false;
        isComplete.value = true;
        setTimeout(() => (isComplete.value = false), 3000);
    };

    return {
        progress,
        totalItems,
        currentItem,
        isProcessing,
        isComplete,
        startProcessing,
        updateProgress,
        completeProcessing,
    };
};
