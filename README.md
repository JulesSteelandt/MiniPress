# 🖧 MiniPress

### MiniPress, un MiniCMS headless qui fait le Maximum

### 👨‍💻 Ce projet est développé par 3 étudiants du groupe DWM2 :
- #### Nicolas Bernardet
- #### Timothée Brindejonc
- #### Jules Steelandt

# Ce projet comporte 3️⃣ grandes parties :

## 💕 Partie MiniPress.core :
MiniPress.core est la partie "back-end" du projet. 
Il consiste en une base de données, accessible par deux moyens :

- ### Une partie Admin 🧔

Accessible sur son conteneur docker dédié, ce site web en PHP, construit avec Eloquent et Slim,
permet de créer des articles avec un formulaire.

Il permet également de publier ou dé publier un article.

- ### Une partie Api 🖹

De la même manière, l'api est construite en PHP avec Eloquent et Slim.
Elle ne possède cependant pas de page web accessible, 
elle retourne uniquement les données demandées en format json.

Cette api permet d'explorer tous les articles, les articles par catégorie, un article en particulier, ou simplement une catégorie d'article.
Elle sera utilisée par les autres services de MiniPress.

## 🖥️ Partie MiniPress.web :
MiniPress.web est le site web programmé en Javascript permettant de consulter les articles.
Il permettra de voir un article en détails, voir les articles d'une catégorie, voir les derniers articles parus ...

## 📱 Partie MiniPress.app :
MiniPress.app est similaire à MiniPress.web, mais en format mobile. Cette app sera développée en Flutter et se servira de l'api pour afficher les différents articles.

Tout comme sa version web, cette app permettra de consulter les articles par ordre de publication, les articles par catégorie, la liste des catégories et un article en détails.
