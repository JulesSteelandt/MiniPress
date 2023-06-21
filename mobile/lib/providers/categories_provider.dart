import 'dart:collection';
import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:http/http.dart' as http;
import 'package:mobile/models/utilisateur.dart';

import '../models/article.dart';
import '../models/categorie.dart';
import '../utils/app_utils.dart';

class CategoriesProvider extends ChangeNotifier {
  // liste locale des catégories
  final List<Categorie> _allCategories = [];

  // liste locale des articles de la catégorie courante
  final List<Article> _currentCategorieArticles = [];

  // getter de la liste de catégories
  UnmodifiableListView<Categorie> get allCategories =>
      UnmodifiableListView(_allCategories);

  // getter des articles de la catégorie courante
  UnmodifiableListView<Article> get currentCategorieArticles =>
      UnmodifiableListView(_currentCategorieArticles);

  // récupère toutes les catégories et les stocke en local
  void fetchCategories() async {
    // récupère les articles et convertit en json
    final response = await http.get(Uri.parse(AppUtils.apiUrl + AppUtils.categories));
    final json = jsonDecode(response.body);

    // pour chaque catégorie de la liste
    for (var categorie in json['categories']) {
      // ajoute à la liste le json converti en catégorie
      _allCategories.insert(0, Categorie.fromJson(categorie['categorie']));
    }
    // notifie les widgets branchés sur le provider
    notifyListeners();
  }

  // récupère et stocke en local les articles de la catégorie donnée
  void fetchCurrentCategorieArticles(Categorie categorie) async {
    // réinitialise la liste d'articles pour la catégorie courante
    _currentCategorieArticles.clear();

    // récupère les articles et convertit en json
    final response = await http.get(Uri.parse('${AppUtils.apiUrl + AppUtils.categories}${categorie.id}/articles/'));
    final json = jsonDecode(response.body);

    // si la catégorie ne possède pas d'articles
    if (json['articles']['count'] == 0) {
      final Article nullArticle = Article(
          id: -1,
          titre: "Il n'y a pas d'articles dans cette catégorie",
          resume: "",
          contenu: "",
          dateCreation: DateTime.now(),
          image: "",
          auteurId: -1);
      nullArticle.setAuteur(Utilisateur(id: -1, nom: 'Aucun', prenom: 'Article'));
      _currentCategorieArticles.add(nullArticle);
      notifyListeners();
      return;
    }

    // pour chaque article
    for (var article in json['articles']['articles']) {
      // récupère le lien vers ses détails
      final articleLink = AppUtils.apiUrl + article['links']['self']['href'];

      // récupère l'article et convertit en json
      final articleResponse = await http.get(Uri.parse(articleLink));
      final articleJson = jsonDecode(articleResponse.body);

      // ajoute l'article à la liste des articles pour la catégorie courante
      _currentCategorieArticles.add(Article.fromJson(articleJson['article']));
    }

    // notifie les widgets branchés sur le provider
    notifyListeners();
  }
}