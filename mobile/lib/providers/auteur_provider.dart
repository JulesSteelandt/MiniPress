import 'dart:collection';
import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:http/http.dart' as http;

import '../models/article.dart';
import '../models/utilisateur.dart';
import '../utils/app_utils.dart';
import '../utils/tri_ordre.dart';

// provider pour les opérations sur les auteurs
class AuteurProvider extends ChangeNotifier {
  // la liste des articles
  final List<Article> _auteurArticles = [];

  // getter pour les articles
  UnmodifiableListView<Article> get auteurArticles => UnmodifiableListView(_auteurArticles);

  // récupère tous les articles et les stocke en local
  void fetchArticlesByAuteur(Utilisateur auteur) async {
    // vide la liste pour le prochain auteur
    _auteurArticles.clear();
    // récupère les articles et convertit en json
    final response = await http.get(Uri.parse('${AppUtils.apiUrl + AppUtils.auteurs}${auteur.id}/articles/'));
    final json = jsonDecode(response.body);

    // si l'auteur ne possède pas d'articles
    if (json['articles']['count'] == 0) {
      // crée un article null pour l'affichage
      final Article nullArticle = Article(
          id: -1,
          titre: "Il n'y a pas d'articles dans cette catégorie",
          resume: "",
          contenu: "",
          dateCreation: DateTime.now(),
          image: "",
          auteurId: -1);
      nullArticle.setAuteur(Utilisateur(id: -1, nom: 'Aucun', prenom: 'Article'));
      _auteurArticles.add(nullArticle);
      notifyListeners();
      return;
    }

    // pour chaque article de la liste
    for (var article in json['articles']['articles']){
      // récupère le lien vers les détails de l'article
      final articleLink = article['link']['self']['href'];

      // récupère toutes les infos de l'article grâce à son lien et transforme en json
      final articleResponse = await http.get(Uri.parse(AppUtils.apiUrl + articleLink));
      final articleJson = jsonDecode(articleResponse.body);

      // convertit le json en article
      final Article finalArticle = Article.fromJson(articleJson['article']);
      // lui associe l'auteur
      finalArticle.setAuteur(auteur);
      // l'ajoute à la liste locale d'articles
      _auteurArticles.insert(0, finalArticle);
    }

    // trie les articles du plus récent au plus ancien
    orderArticles(TriOrdre.ascendant);
    // notifie les widgets branchés sur le provider
    notifyListeners();
  }

  // trie les articles selon l'ordre donné
  void orderArticles(TriOrdre ordre){
    AppUtils.orderArticles(_auteurArticles, ordre);
  }
}