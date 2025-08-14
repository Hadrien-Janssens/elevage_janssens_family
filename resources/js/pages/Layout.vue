<script lang="ts" setup>
import Button from '@/components/Button.vue';
import Cookies from '@/components/Cookies.vue';
import Footer from '@/components/Footer.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

interface User {
    id: number;
    name: string;
    email: string;
}

interface PageProps {
    [key: string]: unknown;
    auth: {
        user: User | null;
    };
}

const page = usePage<PageProps>();
const auth = computed(() => page.props.auth);
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
    <!-- <div class="pt-20 lg:pt-0"></div> -->
    <slot />
    <Link v-if="auth?.user" href="/admin" class="fixed right-5 bottom-5 p-1 pt-20 lg:pt-0">
        <Button class="fixed right-5 bottom-5 p-1 pt-20 lg:pt-0" :label="'espace admin'" />
    </Link>
    <Cookies :showBanner="showBanner" @update:showBanner="showBanner = $event" />
    <Footer @show-banner="showBanner = true" />
</template>
