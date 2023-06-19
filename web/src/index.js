import {getArticles, afficherArticlesSpot} from "./article.js";
import {getCategorie, afficherCategoriesSpot} from "./categorie.js";

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

document.querySelector("#filtrage").addEventListener("keyup", () => {
    filtrerArticlesByTitreOuResume(document.querySelector("#filtrage").textContent)
})
