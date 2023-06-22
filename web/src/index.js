import {getArticles, afficherArticlesSpot,getScreenArticle, afficherArticleTableau, filtreByTitle, filtreByTitleResume} from "./article.js";
import {getCategorie, afficherCategoriesSpot} from "./categorie.js";

/**
 * Affiche les articles dans le dom au lancement de la page
 */
getArticles()
    .then(res =>{
        afficherArticlesSpot(res)
    })

/**
 * Affiche les catégories dans le dom au lancement de la page
 */
getCategorie()
    .then(res =>{
        afficherCategoriesSpot(res)
    })

/**
 * Listener pour le bouton de sens de tri
 */
document.querySelector("#sens").addEventListener("click", () => {
    afficherArticleTableau(getScreenArticle(), false)
})

/**
 * Listener pour le bouton de tri par filtre du titre
 */
document.querySelector("#filtragetitre").addEventListener("keyup", () => {
    filtreByTitle()
})


/**
 * Listener pour le bouton de tri par filtre du titre ou du résumé
 */
document.querySelector("#filtragetitreresume").addEventListener("keyup", () => {
    filtreByTitleResume()
})
