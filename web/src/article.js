import {API} from "./constant.js";

export function getScreenArticle(){
    //Récupérer les articles existant déjà dans la balise et les placer dans un tableau
    let articles = document.querySelectorAll("#articles li");
    let tab = [];
    for (let i = 0; i < articles.length; i++) {
        tab.push(articles[i]);
    }
    return tab;
}

export function afficherArticleTableau(tab, ascendant){
    //Trier le tableau en fonction de l'ordre choisi
    if (!ascendant){
        tab.reverse();
    }

    //Afficher le tableau trié
    let articleUl = document.createElement("ul");
    for (let i = 0; i < tab.length; i++) {
        articleUl.appendChild(tab[i]);
    }
    let articlesSpot = document.querySelector("#articles");
    articlesSpot.innerHTML = "";
    articlesSpot.appendChild(articleUl);
}
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

export function filtreByTitleResume(){
    let tab = [];
    getArticles()
        .then(res =>{
            res.articles.forEach(article => {
                fetch(API+article.links.self.href.replace("/api", ""))
                    .then(response => response.json())
                    .then(art => {
                        if(article.article.titre.toLowerCase().includes(document.querySelector("#filtragetitreresume").value.toLowerCase()) || art.article.resume.toLowerCase().includes(document.querySelector("#filtragetitreresume").value.toLowerCase())) {
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
                        afficherArticleTableau(tab, false)
                    })
            })
        })
}

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
        // articlesSpot.appendChild(articleUl);
        tab = tab.sort((a, b) => {
            // return new Date(a.getAttribute("date")) - new Date(a.getAttribute("date"));
            return a.getAttribute("date").localeCompare(b.getAttribute("date"))
        })
        afficherArticleTableau(tab, true)
    }
}

export function afficherArticleCompletSpot(link) {
    let apilink = link.replace("/api", "")
    fetch(API+apilink)
        .then(response => response.json())
        .then(article => {
            let articleSpot = document.getElementById("article");
            articleSpot.innerHTML = "";
            const titleHTML = document.createElement("p")
            titleHTML.innerHTML = new showdown.Converter().makeHtml(article.article.titre);
            const contentHTML = document.createElement("p")
            contentHTML.innerHTML = new showdown.Converter().makeHtml(article.article.contenu);
            const authorLink = document.createElement("a");
            fetch(`${API}/auteurs/${article.article.auteur}`).then(response => response.json()).then(auteur => {
                authorLink.setAttribute("id", auteur.user.user.id)
                authorLink.textContent = auteur.user.user.nom + " " + auteur.user.user.prenom
            });
            articleSpot = document.getElementById("articles");
            authorLink.id = article.article.auteur;
            authorLink.href = "#";
            authorLink.addEventListener("click", ()=> {
                let baliseUl = document.createElement("ul");
                getArticleByAuteur(authorLink.getAttribute("id"))
                    .then(res => {
                        const articlesSpot = document.querySelector("#articles")
                        articlesSpot.innerHTML = "";
                        let aut = "";
                        res.articles.articles.forEach(article => {
                        // for (let i = 0; i < res.articles.count; i++) {
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
