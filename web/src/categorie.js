import {API} from "./constant.js";
import {displayCatArticles} from "./article.js";

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

export function afficherCategoriesSpot(categories) {
    const categoriesSpot = document.getElementById("categories");
    categoriesSpot.innerHTML = "";

    categories.forEach(function(category) {
        let categoryLink = document.createElement("a");
        categoryLink.href = "#";
        categoryLink.textContent = category.name;
        categoryLink.addEventListener("click", ()=> {
            displayCatArticles(category.id);
        });

        categoriesSpot.appendChild(categoryLink);
    });
}