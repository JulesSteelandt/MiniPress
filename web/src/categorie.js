import {API} from "./constant.js";
import {afficherArticlesSpot, getArticleByCategorieId} from "./article.js";

export function getCategorie(){
    return fetch(`${API}/categories/`)
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

export function afficherCategoriesSpot(cat) {
    const categoriesSpot = document.querySelector("#categories")
    categoriesSpot.innerHTML = "";
    cat.categories.forEach((category) => {
        let hCat = document.createElement("h1");
        let categoryLink = document.createElement("a");
        categoryLink.href = "#";
        categoryLink.classList.add("cat");
        categoryLink.textContent = category.categorie.nom;
        categoryLink.addEventListener("click", ()=> {
            getArticleByCategorieId(category.categorie.id)
                .then(r =>{
                    document.querySelector("#article").innerHTML = "";
                    afficherArticlesSpot(r.articles)
                })

        });
        hCat.append(categoryLink)
        categoriesSpot.appendChild(hCat);
    });
}