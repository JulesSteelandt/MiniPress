import {API} from "./constant.js";


export function getArticles(){

    return fetch(`${API}/articles/`)
        .then(r => {
            if (r.ok){
                return r.json()
            } else {
                Promise.reject(new Error("Problème interne"))
            }
        })
        .catch(e => {
            throw new Error(e.message)
        })
}

export function getArticleById(id){
    return fetch(`${API}/articles/${id}`)
        .then(r => {
            if (r.ok){
                return r.json()
            } else {
                Promise.reject(new Error("Problème interne"))
            }
        })
        .catch(e => {
            console.log("Erreur de récupération de données : ", e.messageerror);
        })
}

export function getArticleByCategorieId(id){
    return fetch(`${API}/categories/${id}/articles`)
        .then(r => {
            if (r.ok){
                return r.json()
            } else {
                Promise.reject(new Error("Problème interne"))
            }
        })
        .catch(e => {
            console.log("Erreur de récupération de données : ", e.messageerror);
        })
}

export function getArticleByAuteur(auteurId){
    return fetch(`${API}/api/auteurs/${auteurId}/articles`)
        .then(response => {
            return response.json()
        })
        .catch(error => {
            console.log("Erreur de récupération de données : ", error);
        });
}


export function afficherArticlesSpot(articles) {
    let tab = [];
    const articlesSpot = document.querySelector("#articles")
    articlesSpot.innerHTML = "";
    let articleUl = document.createElement("ul");

    console.log(articles)
    for (let i = articles.articles.length - 1; i >= 0; i--) {
        let article = articles.articles[i];
        let articleLisr = document.createElement("li");
        let articleLink = document.createElement("a");
        articleLink.href = "#";
        articleLink.textContent = (article.article.titre) + " - " + article.article.date_creation + " par " + article.article.auteur;
        articleLink.addEventListener("click", ()=> {
            afficherArticleCompletSpot(article.links.self.href);
        });
        articleLisr.append(articleLink)
        articleUl.appendChild(articleLisr);
    }
    articlesSpot.appendChild(articleUl);
}

export function afficherArticleCompletSpot(link) {
    let apilink = link.replace("/api", "")
    fetch(API+apilink)
        .then(response => response.json())
        .then(article => {
            console.log(article)
            let articleSpot = document.getElementById("article");
            articleSpot.innerHTML = new showdown.Converter().makeHtml(article.article.titre) + new showdown.Converter().makeHtml(article.article.contenu);
        })
        .catch(error => {
            console.log("Erreur de récupération de données : ", error);
        });
}
