<script setup lang="ts">
import Button from '@/components/Button.vue';
import Menu from '@/components/Menu.vue';
</script>
<template>
    <!-- Menu -->
    <Menu />
    <!-- header -->
    <header class="flex h-[calc(100vh-80px)] flex-col items-center justify-end gap-10">
        <img src="una.png" alt="" width="50%" class="self-end" />
        <h1 class="text-primary text-5xl font-black">Janssens Family</h1>
        <h2>Elevage familial de Scottish & British</h2>
        <img src="urban.jpeg" alt="british short hair black silver tabby" width="50%" class="relative right-10 self-start" />
        <p>Scroll et viens découvrir</p>
    </header>

    <!-- Qui somme-nous -->
    <div class="bg-tertiary m-3 mt-10 flex flex-col gap-3 rounded-lg p-5">
        <h3 class="text-4xl font-black text-white">Qui sommes-nous ?</h3>
        <p class="text-justify text-white">
            Nous sommes un élevage familial où passion, dévouement et amour des félins font partie intégrante de nos valeurs. Un foyer chaleureux où
            les chats grandissent heureux et équilibrés, prêts à devenir le compagnon idéal pour votre famille. Avec un attachement particulier pour
            les Scottish et les British, c’est tout naturellement que nous nous sommes tourné vers cette race pour nous élevage
        </p>
        <Button label="Découvrir" class="self-end" />
    </div>

    <!-- Nos chats -->
    <div class="m-3 mt-10">
        <h3 class="text-primary mb-3 text-4xl font-black">Nos chats</h3>
        <ul class="flex gap-3">
            <li class="border-primary flex basis-1/2 flex-col justify-end rounded-bl-lg border-b-2 border-l-2">
                <img src="reproducteurs.png" alt="chat1" class="rounded-lg" />
                <h4 class="text-center text-lg font-black">Nos reproducteurs</h4>
                <Button label="Découvrir" class="self-end" />
            </li>
            <li class="border-primary flex basis-1/2 flex-col justify-end rounded-tr-lg border-t-2 border-r-2 border-b-2 border-b-transparent">
                <img src="chatons.png" alt="chat1" class="rounded-lg" />
                <h4 class="text-center text-lg font-black">Nos chatons</h4>
                <Button label="Découvrir" class="self-end" />
            </li>
        </ul>
    </div>

    <!-- Contacter nous -->
</template>
