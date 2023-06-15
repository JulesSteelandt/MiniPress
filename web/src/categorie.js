import {API, spotUlArticle, spotUlCategorie} from "./constant.js";

function getCategorie(){
    return fetch(`${API}/categorie/`)
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

export function ajouterCategorieSpot(){
    getCategorie()
        .then(r =>{
            r.categories.forEach(cat =>{
                let liCat = document.createElement("li").value = `${cat.id} - ${cat.nom}`
                spotUlCategorie.append(liCat)
            })
        })
}