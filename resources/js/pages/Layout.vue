<script lang="ts" setup>
import Cookies from '@/components/Cookies.vue';
import Footer from '@/components/Footer.vue';
import { onMounted, ref } from 'vue';

const showBanner = ref(false);
const consentGiven = ref(false);

onMounted(() => {
    const consent = document.cookie.match(/analytics_consent=(yes|no)/);
    if (consent && consent[1] === 'yes') {
        consentGiven.value = true;
    } else if (!consent) {
        showBanner.value = true;
    }
});
</script>

<template>
    <slot />
    <Cookies :showBanner="showBanner" @update:showBanner="showBanner = $event" />
    <Footer @show-banner="showBanner = true" />
</template>
