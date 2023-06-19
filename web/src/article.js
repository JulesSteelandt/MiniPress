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

    articles.articles.forEach(article => {

        let auteurLink = document.createElement("a")
        auteurLink.href = "";
        auteurLink.textContent = new showdown.Converter().makeHtml(article.titre);
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
        articleLink.textContent = new showdown.Converter().makeHtml(article.article.titre) + " - " + article.article.date_creation + " par " + article.article.auteur;
        articleLink.addEventListener("click", ()=> {
            afficherArticleCompletSpot(article.links.self.href);
        });


        articlesSpot.appendChild(articleLink);
    });
}

export function afficherArticleCompletSpot(link) {
    let apilink = link.replace("/api", "")
    fetch(API+apilink)
        .then(response => response.json())
        .then(article => {
            console.log(article)
            let articleSpot = document.getElementById("article");
            articleSpot.innerHTML = "<h1>" + new showdown.Converter().makeHtml(article.article.titre) + "</h1><p>" + new showdown.Converter().makeHtml(article.article.contenu) + "</p>";
        })
        .catch(error => {
            console.log("Erreur de récupération de données : ", error);
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

