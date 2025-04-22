<script lang="ts" setup>
import Footer from '@/components/Footer.vue';
import Menu from '@/components/Menu.vue';
</script>
<template>
    <Menu title="Elevage" />
    <div class="m-3 my-6 p-3">
        <h1 class="text-primary poetsone mb-3 text-3xl">Qui sommes-nous ?</h1>
        <p class="text-justify">
            Bienvenue chez nous, Laura et Hadrien, un jeune couple passionné de chats, situé au cœur du Hainaut, à Morlanwelz. Nous avons
            respectivement 28 et 30 ans et partageons notre amour pour les félins depuis de nombreuses années.
        </p>

        <div class="relative m-auto mt-12 h-64 w-64 bg-amber-100">
            <div class="absolute -top-3 -left-3 z-10 h-52 w-1/2 rounded-lg bg-[#CDC6C2]"></div>
            <img src="hadrien-laura.jpg" alt="" class="absolute inset-0 z-20 h-full w-full rounded-lg object-cover object-center" />
            <div class="absolute -right-3 -bottom-3 z-10 h-52 w-1/2 rounded-lg bg-[#CDC6C2]"></div>
        </div>
    </div>
    <div class="relative m-3 mt-12 mb-0 flex-col justify-end p-3 text-justify">
        <div class="border-primary absolute bottom-0 -left-1 h-1/2 w-1/2 rounded-bl-xl border-b-2 border-l-2"></div>
        <div class="border-primary absolute top-0 -right-1 h-1/2 w-1/2 rounded-tr-xl border-t-2 border-r-2"></div>
        <p>
            Mariés depuis 6 ans, les chats font partie intégrante de notre vie. Nous avons toujours été entourés de ces adorables compagnons à quatre
            pattes, considérés comme des membres à part entière de notre famille. En 2023, nous avons décidé d'agrandir notre tribu en accueillant Una
            et Urban, une scottish fold et un british shorthair qui ont rapidement trouvé leur place parmi nous.
        </p>
        <br />
        <p>
            Pour nous, l'élevage est une véritable passion que nous chérissons chaque jour. Nous chats sont élevés au sein d'un foyer familial, ce qui
            les rend plus sociables et amitieux. Avec notre fille, âgée de 3 ans, ils ont également l’habitude de vivre en présence d'enfants, et nous
            avons constaté que nos chats s'épanouissent également en sa compagnie.
        </p>
        <br />
        <p>
            Si vous recherchez un compagnon félin aimant et bien élevé, nous sommes là pour vous guider et vous aider à trouver le compagnon idéal qui
            correspondra à vos besoins et à votre style de vie.
        </p>
        <br />
        <p>N'hésitez pas à nous contacter pour découvrir notre élevage familial, où passion, dévouement et amour des chats sont les maîtres-mots.</p>
    </div>
    <p class="grapenuts relative -top-5 pr-5 text-right text-2xl font-bold text-[#51687F]">Janssens Family</p>
    <Footer />
</template>
