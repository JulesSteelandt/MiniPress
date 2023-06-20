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
    return fetch(`${API}/auteurs/${auteurId}/articles`)
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
    let articleUl = document.createElement("ul");

    articles.articles.forEach(article => {
        let articleLisr = document.createElement("li");
        let articleLink = document.createElement("a");
        articleLink.href = "#";
        fetch(`${API}/auteurs/${article.article.auteur}`).then(response => response.json()).then(auteur => {
            console.log(auteur)
            articleLink.textContent = (article.article.titre) + " - " + article.article.date_creation + " par " + auteur.user.user.prenom + " " + auteur.user.user.nom;

        });
        articleLink.addEventListener("click", ()=> {
            afficherArticleCompletSpot(article.links.self.href);
        });
        articleLisr.append(articleLink)
        articleUl.appendChild(articleLisr);
    });
    articlesSpot.appendChild(articleUl);
}

export function afficherArticleCompletSpot(link) {
    let apilink = link.replace("/api", "")
    fetch(API+apilink)
        .then(response => response.json())
        .then(article => {
            console.log(article)
            let articleSpot = document.getElementById("article");
            articleSpot.innerHTML = "";
            const titleHTML = document.createElement("p")
            titleHTML.innerHTML = article.article.titre;
            const contentHTML = document.createElement("p")
            contentHTML.innerHTML = article.article.contenu;
            const authorLink = document.createElement("a");
            console.log(`${API}/auteurs/${article.article.auteur}`)
            fetch(`${API}/auteurs/${article.article.auteur}`).then(response => response.json()).then(auteur => {
                authorLink.setAttribute("id", auteur.user.user.id)
                authorLink.textContent = auteur.user.user.nom + " " + auteur.user.user.prenom
            });
            authorLink.id = article.article.auteur;
            authorLink.href = "#";
            authorLink.addEventListener("click", ()=> {
                let baliseUl = document.createElement("ul");
                getArticleByAuteur(authorLink.getAttribute("id"))
                    .then(res => {
                        console.log(res)
                        const articlesSpot = document.querySelector("#articles")
                        articlesSpot.innerHTML = "";
                        let aut = "";
                        res.articles.forEach(article => {
                            let link = article.link.self.href.replace("/api", "");
                            console.log(API+link)
                            fetch(API+link)
                                .then(response => response.json())
                                .then(art => {
                                    let a = document.createElement("li");
                                    let li = document.createElement("a");
                                    li.textContent = art.article.titre+" - "+art.article.date_creation;
                                    li.href = "#";
                                    li.addEventListener("click", ()=> {
                                        afficherArticleCompletSpot("/api/articles/"+art.article.id);
                                    })
                                    a.appendChild(li);
                                    baliseUl.appendChild(a);
                                    articleSpot.innerHTML = "";
                                    let titre = document.createElement("h1");
                                    fetch(API+"/auteurs/"+art.article.auteur)
                                        .then(response => response.json()).then(auteur => {
                                        titre.textContent = "Articles de "+auteur.user.user.nom + " " + auteur.user.user.prenom;
                                    })
                                    articleSpot.appendChild(titre);
                                    articleSpot.appendChild(baliseUl);
                                })
                        })
                    })
                // afficherArticlesSpot(getArticleByAuteur(authorLink.getAttribute("id")));
            })
            articleSpot.appendChild(titleHTML)
            articleSpot.appendChild(authorLink);
            articleSpot.appendChild(contentHTML);


        })
        .catch(error => {
            console.log("Erreur de récupération de données : ", error);
        });
}
