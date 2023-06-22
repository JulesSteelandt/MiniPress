import {API} from "./constant.js";

/**
 * Récupère les articles du DOM
 * @returns {*[]}
 */
export function getScreenArticle(){
    let articles = document.querySelectorAll("#articles li");
    let tab = [];
    for (let i = 0; i < articles.length; i++) {
        tab.push(articles[i]);
    }
    return tab;
}

/**
 * Affiche les articles et les trie
 * @param tab
 * @param ascendant
 */
export function afficherArticleTableau(tab, ascendant){
    if (!ascendant){
        tab.reverse();
    }

    let articleUl = document.createElement("ul");
    for (let i = 0; i < tab.length; i++) {
        articleUl.appendChild(tab[i]);
    }
    let articlesSpot = document.querySelector("#articles");
    articlesSpot.innerHTML = "";
    articlesSpot.appendChild(articleUl);
}

/**
 * Récupère les articles
 * @returns {Promise<Response>}
 */
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

/**
 * Récupère un article par catégorie
 * @param id
 * @returns {Promise<Response>}
 */
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

/**
 * Récupère un article par son auteur
 * @param auteurId
 * @returns {Promise<any>}
 */
export function getArticleByAuteur(auteurId){
    return fetch(`${API}/auteurs/${auteurId}/articles`)
        .then(response => {
            return response.json()
        })
        .catch(error => {
            console.log("Erreur de récupération de données : ", error);
        });
}

/**
 * Récupère un article par mot clé dans le titre ou le résumé
 */
export function filtreByTitleResume(){
    let tab = [];
    getArticles()
        .then(res =>{
            res.articles.forEach(article => {
                fetch(API+article.links.self.href.replace("/api", ""))
                    .then(response => response.json())
                    .then(art => {
                        if(article.article.titre.toLowerCase().includes(document.querySelector("#filtragetitreresume").value.toLowerCase()) || art.article.resume.toLowerCase().includes(document.querySelector("#filtragetitreresume").value.toLowerCase())) {
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
                        afficherArticleTableau(tab, false)
                    })
            })
        })
}

/**
 * Récupère un article par mot clé dans le titre
 */
export function filtreByTitle(){
    let tab = [];
    getArticles()
        .then(res =>{
            res.articles.forEach(article => {
                if(article.article.titre.toLowerCase().includes(document.querySelector("#filtragetitre").value.toLowerCase())){
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
            afficherArticleTableau(tab, false)
        })
}


/**
 * Affiche article sous forme de liste dans le dom
 * @param articles
 */
export function afficherArticlesSpot(articles) {
    let tab = [];
    const articlesSpot = document.querySelector("#articles")
    articlesSpot.innerHTML = "";
    let articleUl = document.createElement("ul");
    if (articles.count !== 0) {
        articles.articles.forEach((article) => {

            let articleLisr = document.createElement("li");
            let articleLink = document.createElement("a");
            articleLisr.setAttribute("date", article.article.date_creation);
            articleLink.href = "#";
            fetch(`${API}/auteurs/${article.article.auteur}`).then(response => response.json()).then(auteur => {
                articleLink.textContent = (article.article.titre) + " - " + article.article.date_creation + " par " + auteur.user.user.prenom + " " + auteur.user.user.nom;

            });
            articleLink.addEventListener("click", () => {
                afficherArticleCompletSpot(article.links.self.href);
            });
            articleLisr.append(articleLink)
            tab.push(articleLisr)
            articleUl.appendChild(articleLisr);
        });
        tab = tab.sort((a, b) => {
            return a.getAttribute("date").localeCompare(b.getAttribute("date"))
        })
        afficherArticleTableau(tab, true)
    }
}

/**
 * Affiche article complet dans le dom
 * @param link
 */
export function afficherArticleCompletSpot(link) {
    let apilink = link.replace("/api", "")
    fetch(API+apilink)
        .then(response => response.json())
        .then(article => {
            let articleSpot = document.querySelector("#article");
            articleSpot.innerHTML = "";
            const titleHTML = document.createElement("p")
            const imageHTML = document.createElement("img")
            imageHTML.src = article.article.image
            const sautHTML = document.createElement("br")
            titleHTML.innerHTML = new showdown.Converter().makeHtml(article.article.titre);
            const contentHTML = document.createElement("p")
            const resumeHTML = document.createElement("p")
            resumeHTML.innerHTML = new showdown.Converter().makeHtml(article.article.resume);
            contentHTML.innerHTML = new showdown.Converter().makeHtml(article.article.contenu);
            const authorLink = document.createElement("a");
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
                        const articlesSpot = document.querySelector("#articles")
                        articlesSpot.innerHTML = "";
                        res.articles.articles.forEach(article => {
                            let link = article.link.self.href.replace("/api", "");
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
                                    articlesSpot.innerHTML = "";
                                    let titre = document.createElement("h1");
                                    fetch(API+"/auteurs/"+art.article.auteur)
                                        .then(response => response.json()).then(auteur => {
                                        titre.textContent = "Articles de "+auteur.user.user.nom + " " + auteur.user.user.prenom;
                                    })
                                    articlesSpot.appendChild(titre);
                                    articlesSpot.appendChild(baliseUl);
                                })
                        })
                    })
            })
            articleSpot.appendChild(authorLink);
            articleSpot.appendChild(titleHTML)
            articleSpot.appendChild(resumeHTML);
            articleSpot.appendChild(sautHTML);
            articleSpot.appendChild(imageHTML);
            articleSpot.appendChild(contentHTML);


        })
        .catch(error => {
            console.log("Erreur de récupération de données : ", error);
        });
}