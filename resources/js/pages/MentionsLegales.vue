<script setup lang="ts">
import Menu from '@/components/Menu.vue';
import { Head } from '@inertiajs/vue3';
import { Brain, Cookie, LockOpen, PenTool, Scale, Server } from 'lucide-vue-next';
import Layout from './Layout.vue';
</script>

<template>
    <Head>
        <title>Mentions Légales - Janssens Family</title>
        <meta
            name="description"
            content="Consultez les mentions légales du site de l'élevage Janssens Family, éleveur familial de Scottish et British."
        />
        <meta name="keywords" content="mentions légales, élevage familial, Scottish, British, Janssens Family" />
        <meta name="author" content="Janssens Family" />
        <meta property="og:title" content="Mentions Légales - Janssens Family" />
        <meta
            property="og:description"
            content="Consultez les mentions légales du site de l'élevage Janssens Family, éleveur familial de Scottish et British."
        />
        <meta property="og:image" content="/images/mentions-legales.jpg" />
        <meta property="og:url" content="https://www.janssensfamily.be/mentions-legales" />
        <meta property="og:type" content="website" />
    </Head>

    <Menu title="Mentions Légales" />
    <Layout>
        <div class="mx-auto w-full lg:mt-20 lg:py-6">
            <section class="prose mx-auto max-w-3xl space-y-10 p-4 text-left">
                <h1 class="mb-4 flex items-center gap-2 text-2xl font-bold"><Scale /> Mentions légales</h1>

                <h2 class="mt-6 mb-2 flex items-center gap-2 text-xl font-semibold"><PenTool /> Éditeur du site</h2>
                <p>
                    Ce site est édité par Monsieur <strong>Hadrien Janssens</strong>, développeur indépendant. <br />
                    Les contenus sont rédigés et mis à jour par Madame<strong> Laura Blanni</strong>, éleveuse agréée. <br /><br />
                    <strong>Nom de l’élevage :</strong> Élevage Janssens Family<br />
                    <strong>Adresse :</strong> Rue Joseph Wauters 81, 7140 Morlanwelz, Belgique<br />
                    <strong>Statut :</strong> Éleveur agréé par la Région wallonne<br />
                    <strong>Email de contact :</strong> <a href="mailto:laurablanni7@hotmail.com">elevagejanssensfamily@gmail.com</a>
                </p>

                <h2 class="mt-6 mb-2 flex items-start gap-2 text-xl font-semibold"><Server /> Hébergeur</h2>
                <p>
                    <strong>OVH SAS</strong><br />
                    2 rue Kellermann, 59100 Roubaix, France<br />
                    Site : <a href="https://www.ovh.com" target="_blank">www.ovh.com</a>
                </p>

                <h2 class="mt-6 mb-2 flex items-start gap-2 text-xl font-semibold"><Brain /> Droits d’auteur et propriété intellectuelle</h2>
                <p>
                    L’ensemble de ce site (structure, design, textes, images, photos, logo, etc.) constitue une œuvre protégée.
                    <br />
                    Le <strong>logo</strong> réalisé par Monsieur Hadrien Janssens est également protégé par le droit d’auteur.
                    <br />
                    Toute reproduction, modification ou diffusion, même partielle, est interdite sans autorisation écrite. Les infractions sont
                    passibles de poursuites civiles et/ou pénales.
                </p>

                <h2 class="mt-6 mb-2 flex items-start gap-2 text-xl font-semibold"><Scale /> Responsabilité</h2>
                <p>
                    Les informations présentes sur ce site sont données à titre indicatif. Elles peuvent être modifiées à tout moment, sans préavis.
                    L’élevage Janssens Family ne peut être tenu responsable d’éventuelles erreurs ou omissions.
                </p>

                <h2 class="mt-6 mb-2 flex items-start gap-2 text-xl font-semibold"><LockOpen /> Données personnelles</h2>
                <p>
                    Les données transmises via le formulaire de contact (nom, prénom, téléphone, email) sont envoyées par email à Madame Laura Blanni,
                    sans stockage en base de données. Ces données ne sont jamais revendues ni utilisées à d’autres fins.

                    <br />
                    Vous pouvez demander la suppression de vos données à tout moment par email à :
                    <a href="mailto:elevagejanssensfamily@gmail.com">elevagejanssensfamily@gmail.com</a>
                </p>

                <h2 class="mt-6 mb-2 flex items-start gap-2 text-xl font-semibold"><Cookie /> Cookies</h2>
                <p>Ce site utilise des cookies nécessaires à son bon fonctionnement.</p>
                <p>
                    <strong>Google Analytics</strong> est utilisé pour mesurer l’audience. Les cookies recueillent des données anonymes sur votre
                    navigation. Vous pouvez à tout moment configurer votre navigateur pour les refuser.
                </p>
                <p>En naviguant sur ce site, vous acceptez l’utilisation de ces cookies.</p>
            </section>
        </div>
    </Layout>
</template>
