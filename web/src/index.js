import {
    getArticles,
    afficherArticlesSpot,
    getScreenArticle,
    afficherArticleTableau,
    afficherArticleCompletSpot
} from "./article.js";
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

document.querySelector("#filtragetitre").addEventListener("keyup", () => {
    let tab = [];
    getArticles()
        .then(res =>{
            console.log(res)
            res.articles.forEach(article => {
                if(article.article.titre.toLowerCase().includes(document.querySelector("#filtragetitre").value.toLowerCase())){
                    //On met en forme le document de manière à pouvoir appeler la fonction afficherArticleTableau, le tableau doit contenir une liste de a qui quand on clique dessus affiche l'article en gros comme fait la fonction afficherArticlesCompletSpot
                    let li = document.createElement("li");
                    let a = document.createElement("a");
                    a.textContent = article.article.titre;
                    a.href = "#";
                    a.onclick = () => {
                        afficherArticleCompletSpot(article.links.self.href);
                    }
                    li.appendChild(a);
                    tab.push(li);
                }
            })
            afficherArticleTableau(tab, boo)
        })
})
