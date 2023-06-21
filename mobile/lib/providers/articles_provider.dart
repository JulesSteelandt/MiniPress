import 'dart:collection';
import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:http/http.dart' as http;
import 'package:mobile/utils/app_utils.dart';

import '../models/article.dart';

class ArticlesProvider extends ChangeNotifier {
  // la liste des articles
  final List<Article> _allArticles = [];

  // getter pour les articles
  UnmodifiableListView<Article> get allArticles => UnmodifiableListView(_allArticles);

  // récupère tous les articles et les stocke en local
  void fetchArticles() async {
    // récupère les articles et convertit en json
    final response = await http.get(Uri.parse(AppUtils.apiUrl + AppUtils.articles));
    final json = jsonDecode(response.body);

    // pour chaque article de la liste
    for (var article in json['articles']){
      // récupère le lien vers les détails de l'article
      final articleLink = article['links']['self']['href'];

      // récupère toutes les infos de l'article grâce à son lien et transforme en json
      final articleResponse = await http.get(Uri.parse(AppUtils.apiUrl + articleLink));
      final articleJson = jsonDecode(articleResponse.body);

      // ajoute à la liste le json converti en article
      _allArticles.insert(0, Article.fromJson(articleJson['article']));
    }

    // attends la récupération des auteurs pour chaque article
    await AppUtils.fetchAuteurForArticles(_allArticles);
    // notifie les widgets branchés sur le provider
    notifyListeners();
  }
}