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
    const articlesSpot = document.querySelector("#articles")
    articlesSpot.innerHTML = "";

    articles.forEach(article => {

        let auteurLink = document.createElement("a")
        auteurLink.href = "#";
        auteurLink.textContent = article.auteur;
        auteurLink.dataset.auteur = article.auteur;
        auteurLink.addEventListener("click", ()=> {
            let auteur = auteurLink.dataset.auteur;
            getArticleByAuteur(auteur)
                .then(res =>{
                    afficherArticlesSpot(res)
                })
        })


        let articleLink = document.createElement("a");
        articleLink.href = "#";
        articleLink.textContent = article.titre + " - " + article.date_creation + " par " + auteurLink;
        articleLink.addEventListener("click", ()=> {
            afficherArticleCompletSpot(article.id);
        });


        articlesSpot.appendChild(articleLink);
    });
}

export function afficherArticleCompletSpot(articleId) {
    fetch(`${API}/articles/${articleId}`)
        .then(response => response.json())
        .then(article => {
            let articleSpot = document.getElementById("article");
            articleSpot.innerHTML = "<h1>" + article.title + "</h1><p>" + article.content + "</p>";
        })
        .catch(error => {
            console.log("Erreur de récupération de données : ", error.messageerror);
        });
}
export function displayCatArticles(categoryId) {
    fetch("/api/categories/" + categoryId + "/articles")
        .then(response => response.json())
        .then(articles => {
            afficherArticlesSpot(articles);
        })
        .catch(error => {
            console.log("Erreur de récupération de données : ", error.messageerror);
        });
}

export function trierDatesArticles(articles, ascendant) {
    articles.sort(function(a, b) {
        let dateA = new Date(a.date_creation);
        let dateB = new Date(b.date_creation);
        return ascendant ? dateA - dateB : dateB - dateA;
    });
    afficherArticlesSpot(articles);
}

export function filtrerArticlesByTitreOuResume(articles, keyword) {
    let articleFiltre = articles.filter((article) => {
        let titre = article.titre.toLowerCase().includes(keyword.toLowerCase());
        let resume = article.resume.toLowerCase().includes(keyword.toLowerCase());
        return titre || resume;
    });

    afficherArticlesSpot(articleFiltre);
}

