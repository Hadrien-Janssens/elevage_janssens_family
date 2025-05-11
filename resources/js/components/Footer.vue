<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import { Facebook, IdCard, MapPinHouse, Phone, Scale } from 'lucide-vue-next';
</script>

<template>
    <footer class="mt-6 flex flex-col justify-between bg-[#F5F5F5] p-3 sm:flex-row">
        <div>
            <p class="flex items-center gap-2"><IdCard class="h-4 w-4" />N° agrément GH0468795</p>

            <p class="flex items-center gap-2"><Phone class="h-4 w-4" /> <a href="tel:+32497359097">0497/35.90.97</a></p>

            <p>
                <a
                    href="https://www.google.be/maps/place/Morlanwelz/@50.4554121,4.2455833,17.48z/data=!4m6!3m5!1s0x47c2374a6a886c43:0xa7b7428a43576cd7!8m2!3d50.4550853!4d4.2426074!16zL20vMDE3cWN3?entry=ttu&g_ep=EgoyMDI1MDUwNy4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="flex items-center gap-2"
                >
                    <MapPinHouse class="h-4 w-4" /><strong>Morlanwelz </strong>
                </a>
            </p>

            <p class="flex items-center gap-2">
                <a
                    href="https://www.facebook.com/profile.php?id=61563373375978&locale=fr_FR"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="flex items-center gap-2"
                >
                    <Facebook class="h-4 w-4" /> Facebook</a
                >
            </p>

            <p class="flex items-center gap-2">
                <Link :href="route('mentions')" rel="noopener noreferrer" class="flex items-center gap-2">
                    <Scale class="h-4 w-4" />
                    <p>Mentions légales</p>
                </Link>
            </p>
        </div>

        <div class="self-end">
            <p>
                Développé par
                <a href="mailto:hadrien.janssens7@gmail.com" class="text-[#51687F] underline" target="_blank" rel="noopener noreferrer">
                    Hadrien Janssens
                </a>
                🚀
            </p>
        </div>
    </footer>
</template>
