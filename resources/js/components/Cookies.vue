<script setup lang="ts">
import { Check, Cookie, X } from 'lucide-vue-next';

defineProps<{
    showBanner: boolean;
}>();

const consent = document.cookie.match(/analytics_consent=yes/);
console.log(consent, document.cookie.match(/analytics_consent=yes/));

const emit = defineEmits<{
    (event: 'update:showBanner', value: boolean): void;
}>();

const accept = () => {
    document.cookie = 'analytics_consent=yes; path=/; max-age=31536000';
    emit('update:showBanner', false);
    window.location.reload();
};

const decline = () => {
    document.cookie = 'analytics_consent=no; path=/; max-age=31536000';
    emit('update:showBanner', false);
    window.location.reload();
};
</script>

<template>
    <div v-if="showBanner" class="bg-primary fixed bottom-0 z-50 w-full p-4 text-center font-bold text-white">
        <div class="absolute top-0 right-0 cursor-pointer p-2 duration-300 hover:scale-[102%]" @click="emit('update:showBanner', false)"><X /></div>
        <p class="flex justify-center gap-2"><Cookie class="text-orange-900" /> Ce site utilise des cookies à des fins de mesure d'audience.</p>
        <p v-if="consent && consent[0] === 'analytics_consent=yes'" class="flex justify-center gap-2">
            <Check class="text-green-700" />Votre consentement a été enregistré.
        </p>
        <button
            @click="accept"
            class="mx-2 mt-3 rounded bg-[#51687F] px-4 py-2 duration-300 hover:scale-[102%] hover:cursor-pointer hover:bg-[#526d88] hover:shadow-md"
        >
            Accepter
        </button>
        <button
            @click="decline"
            class="mx-2 rounded bg-white px-4 py-2 text-[#51687F] duration-300 hover:scale-[102%] hover:cursor-pointer hover:bg-[#dadada] hover:shadow-md"
        >
            Refuser
        </button>
    </div>
</template>
