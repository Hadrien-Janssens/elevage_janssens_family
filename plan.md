# Analyse et Plan d'Action

## Problèmes identifiés

1. **Incohérence des variables entre Frontend et Backend :**
   - Dans `Create.vue`, on tente d'utiliser `photos`, `videos`, et `orders_photo` mais la logique d'ordre n'est pas finalisée et n'est pas liée correctement aux fichiers.
   - Dans `Edit.vue`, on utilise `new_photos`, `deleted_images`, `existingPhotoOrder`, et `newPhotoOrder`. La logique de formulaire est complètement différente de `Create.vue`.
   - Dans `KittenController`, les fonctions `store` et `update` s'attendent à des variables différentes et la gestion de l'ordre est soit basique, soit commentée (comme `existingPhotoOrder`).

2. **Gestion des vidéos absente dans l'édition :**
   - `Edit.vue` ne permet pas d'ajouter, de voir ou de supprimer des vidéos.
   - `update` dans le contrôleur n'a aucune logique pour le traitement des vidéos.

3. **Mélange des médias, ordre global, et contraintes de Base de Données :**
   - L'ordre doit pouvoir mélanger les photos et les vidéos de manière fluide. 
   - Actuellement, les vidéos sont ajoutées en DB sans spécifier d'`order`. Comme la colonne `order` n'a pas de valeur par défaut dans la migration, cela peut causer des erreurs.
   - Il n'y a pas de moyen explicite de différencier une photo d'une vidéo dans la base de données `images_kittens` (à part l'extension du fichier). 

## Plan d'Action pour Homogénéiser et Corriger

Pour rendre le code homogène, consistant et évolutif, nous allons unifier la façon dont les médias (photos et vidéos) sont envoyés au serveur, que ce soit pour une création ou une édition.

### 1. Base de données
- Créer une nouvelle migration pour altérer la table `images_kittens`.
- Ajouter une colonne `is_video` (boolean, par défaut `false`). Cela permet d'identifier facilement les vidéos tout en restant 100% rétrocompatible avec les photos déjà existantes.
- Modifier la colonne `order` pour qu'elle ait une valeur par défaut de `0` (pour éviter les erreurs d'insertion).

### 2. Backend (`KittenController.php`)
- **Standardisation de la charge utile (Payload) :** Les méthodes `store` et `update` s'attendront exactement aux mêmes champs pour les médias :
  - `new_photos` : Fichiers photos.
  - `new_videos` : Fichiers vidéos.
  - `deleted_media` : IDs des médias (photos ou vidéos) à supprimer.
  - `media_order` : Tableau de chaînes définissant l'ordre final. Exemple : `["existing:15", "new_photo:0", "new_video:0"]`.
- **Refactorisation de la logique de sauvegarde :**
  1. Supprimer les médias dans `deleted_media`.
  2. Sauvegarder les nouveaux fichiers en DB (avec `order = 0`) et stocker leurs modèles créés en mémoire.
  3. Parcourir `media_order` pour attribuer la valeur finale de `order` (basée sur l'index) à chaque média (qu'il soit existant ou fraîchement créé).

### 3. Frontend (`Create.vue` et `Edit.vue`)
- **Unification de l'état des médias :**
  - Création d'un tableau réactif unique `mediaItems` contenant tous les médias (existants et nouveaux) avec leurs propriétés (source, type, fichier, id).
- **Interface Utilisateur :**
  - Un seul composant `vuedraggable` qui boucle sur `mediaItems`. Ainsi, l'administrateur peut ordonner les photos et les vidéos ensemble, de manière visuelle.
- **Soumission du formulaire :**
  - Juste avant l'envoi, le frontend parcourt `mediaItems` pour populer `new_photos`, `new_videos`, et générer le tableau `media_order` qui donne l'ordre d'affichage exact au backend.

Cela va rendre le code beaucoup plus propre, sans dupliquer la logique entre la création et l'édition.
