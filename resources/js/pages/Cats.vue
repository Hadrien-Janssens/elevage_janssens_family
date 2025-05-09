<script lang="ts" setup>
import CatsListing from '@/components/CatsListing.vue';
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';

defineProps({
    cats: {
        required: false,
    },
});
</script>

<template>
    <Menu title="Nos chats" />

    <div class="mx-auto py-6">
        <h2 class="poetsone mb-6 px-4 text-center text-3xl text-[#B5A9A4]">Nos reproducteurs</h2>
        <CatsListing :kittens="cats" />
    </div>
    <Footer />
</template>
