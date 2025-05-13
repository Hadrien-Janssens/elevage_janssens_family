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
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NMF8WZ840F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NMF8WZ840F');
    </script>

    <slot />
    <Cookies :showBanner="showBanner" @update:showBanner="showBanner = $event" />
    <Footer @show-banner="showBanner = true" />
</template>
