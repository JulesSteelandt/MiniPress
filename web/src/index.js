import {
    getArticles,
    afficherArticlesSpot,
    getScreenArticle,
    afficherArticleTableau,
    afficherArticleCompletSpot, filtreByTitle, filtreByTitleResume
} from "./article.js";
import {getCategorie, afficherCategoriesSpot} from "./categorie.js";
import {API} from "./constant.js";

getArticles()
    .then(res =>{
        afficherArticlesSpot(res)
    })

getCategorie()
    .then(res =>{
        afficherCategoriesSpot(res)
    })

document.querySelector("#sens").addEventListener("click", () => {
    afficherArticleTableau(getScreenArticle(), false)
})

document.querySelector("#filtragetitre").addEventListener("keyup", () => {
    filtreByTitle()
})


document.querySelector("#filtragetitreresume").addEventListener("keyup", () => {
    filtreByTitleResume()
})
