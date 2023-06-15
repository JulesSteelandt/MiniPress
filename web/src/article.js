import {API, spotUlArticle} from "./constant.js";

function getArticles(){
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

function getArticleById(id){
    return fetch(`${API}/articles/${id}`)
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

export function ajouterArticleSpot(){
    getArticles()
        .then(r =>{
            r.articles.forEach(art =>{
                let liArt = document.createElement("li").value = `${art.titre} écrit par ${art.auteur} le ${date_creation}`
                spotUlArticle.append(liArt)
            })
        })
}