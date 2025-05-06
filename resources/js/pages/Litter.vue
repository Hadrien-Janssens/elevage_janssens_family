<script lang="ts" setup>
import Menu from '@/components/Menu.vue';

defineProps({
    litter: {
        required: false,
    },
});
</script>

<template>
    <Menu :title="litter?.name" />

    <div class="m-3 my-6">
        <h1>{{ litter?.name }}</h1>
    </div>
</template>
