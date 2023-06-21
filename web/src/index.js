import {
    getArticles,
    afficherArticlesSpot,
    getScreenArticle,
    afficherArticleTableau,
    afficherArticleCompletSpot, filtreByTitle, filtreByTitleResume
} from "./article.js";
import {getCategorie, afficherCategoriesSpot} from "./categorie.js";
import {API} from "./constant.js";

let boo = true;

getArticles()
    .then(res =>{
        afficherArticlesSpot(res)
    })

getCategorie()
    .then(r=>{
        console.log(r)})
getCategorie()
    .then(res =>{
        afficherCategoriesSpot(res)
    })

document.querySelector("#sens").addEventListener("click", () => {
    boo = !boo;
    afficherArticleTableau(getScreenArticle(), boo)
})

document.querySelector("#filtragetitre").addEventListener("keyup", () => {
    filtreByTitle()
})


document.querySelector("#filtragetitreresume").addEventListener("keyup", () => {
    filtreByTitleResume()
})
