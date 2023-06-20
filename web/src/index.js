import {getArticles, afficherArticlesSpot, getScreenArticle, afficherArticleTableau} from "./article.js";
import {getCategorie, afficherCategoriesSpot} from "./categorie.js";

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
