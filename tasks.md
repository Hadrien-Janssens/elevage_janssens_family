# Tâches à réaliser pour l'homogénéisation des chatons

## 1. Base de données
- [x] Créer une nouvelle migration (ex: `php artisan make:migration alter_images_kittens_add_is_video_and_default_order`).
- [x] Dans la migration, ajouter la colonne `is_video` (boolean, valeur par défaut `false`) à la table `images_kittens`.
- [x] Dans la migration, modifier la colonne `order` pour lui attribuer une valeur par défaut de `0`.
- [x] Exécuter la migration.

## 2. Backend (`KittenController.php`)
- [x] Mettre à jour les règles de validation (méthodes `store` et `update`) pour accepter : `new_photos`, `new_videos`, `media_order`, et `deleted_media`.
- [x] Refactoriser la méthode `store` :
  - Parcourir et enregistrer les fichiers de `new_photos` et `new_videos` en base de données avec l'ordre par défaut (0).
  - Parcourir le tableau `media_order` pour attribuer le bon ordre à chaque média nouvellement inséré.
- [x] Refactoriser la méthode `update` :
  - Supprimer les images/vidéos dont les IDs sont dans `deleted_media` (sur le disque et en base).
  - Enregistrer les nouveaux fichiers (`new_photos` et `new_videos`) avec un ordre temporaire à 0.
  - Parcourir le tableau `media_order` pour mettre à jour l'ordre de tous les médias (nouveaux et existants).

## 3. Frontend (Vue.js)
- [x] Mettre à jour le typage (ex: `types/index.ts` si existant) pour ajouter la propriété `is_video` au type `Images`.
- [x] Dans `Create.vue` :
  - Remplacer les listes séparées de prévisualisation par une liste unifiée `mediaItems` (qui contient à la fois les photos et les vidéos).
  - Mettre à jour le template pour afficher correctement un `<video>` ou un `<img>` dans le composant `vuedraggable` selon le type du média.
  - Mettre à jour la méthode de soumission (`submit`) pour préparer le Payload unifié (`new_photos`, `new_videos`, `media_order`).
- [x] Dans `Edit.vue` :
  - Charger les médias existants dans la liste unifiée `mediaItems` (en détectant si cest une vidéo grâce à `is_video`).
  - Implémenter la même logique de drag and drop et de prévisualisation que pour la création.
  - Mettre à jour la méthode `submit` pour envoyer le Payload unifié (identique à `Create.vue`, avec l'ajout de `deleted_media`).

## 4. Tests et Vérifications
- [ ] Créer un chaton avec plusieurs photos et vidéos mélangées, puis vérifier l'ordre en base de données.
- [ ] Éditer le chaton créé : ajouter une nouvelle vidéo au milieu des photos, supprimer une ancienne photo, et vérifier que la sauvegarde fonctionne parfaitement.
