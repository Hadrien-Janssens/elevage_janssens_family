<script lang="ts" setup>
import Button from '@/components/Button.vue';
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';
</script>
<template>
    <Menu title="Réservation et conditions" />
    <div class="mx-auto max-w-3xl">
        <div class="relative m-3 mt-12 mb-0 flex-col justify-end p-3 text-justify">
            <div class="border-primary absolute bottom-0 -left-1 h-1/2 w-1/2 rounded-bl-xl border-b-2 border-l-2"></div>
            <div class="border-primary absolute top-0 -right-1 h-1/2 w-1/2 rounded-tr-xl border-t-2 border-r-2"></div>
            <h1 class="text-primary poetsone m-3 mb-6 ml-0 text-3xl">Conditions d'adoption</h1>
            <p>Tous nos chatons sont disponibles à partir de 12 semaines.</p>
            <p>
                Ils sont vendus pucés, vaccinés, vermifugés, traités contre les puces/parasites et munis de leur passeport européen au prix de 900€.
            </p>
            <p>Le chaton partira également avec un petit kit de départ offert qui comprend : croquette, friandise et jeu.</p>
            <p>
                Nos chatons sont élevés dans l’amour et la bienveillance. C’est pour cette raison que nous nous réservons le droit de lui choisir la
                meilleur des familles et nous nous réservons le droit de refuser une adoption si celle-ci ne convient pas.
            </p>
        </div>

        <h2 class="text-primary poetsone m-3 mt-10 text-3xl">Réservation</h2>
        <div class="bg-tertiary z-40 m-3 flex flex-col gap-3 rounded-xl p-5">
            <p class="text-justify text-white">
                Vous avez craqué pour un de nos chatons ? <br />
                Pas de panique, vous pouvez le réserver à partir de ses 6 semaines. <br />
                Comment faire ? <br />
                Vous prenez contact avec nous afin de vérifier la disponibilité du chaton et nous planifions ensuite une visite si vous souhaitez le
                voir. La réservation est validée après le paiement d’un acompte de 100 euros.
            </p>
        </div>
        <h2 class="text-primary poetsone m-3 mt-10 text-3xl">Nos conseils pour acceuillir votre chaton</h2>
        <div class="z-40 m-3 flex flex-col gap-3 rounded-xl bg-[#B5A9A4] p-5">
            <p class="text-justify text-white">
                Afin que votre nouveau petit protégé ait le temps de s’adapter à vous lors de son arrivée, nous vous conseillons de venir le chercher
                le plus tôt possible dans la journée. Cela lui évitera de se retrouver immédiatement tout seul pendant la nuit. Il aura ainsi le temps
                de s’habituer à son nouvel environnement mais aussi à sa nouvelle famille.
            </p>
            <Button label="Lire plus" class="mt-3 self-end" />
        </div>
    </div>
    <Footer />
</template>
