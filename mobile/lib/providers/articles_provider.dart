import 'dart:collection';
import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:http/http.dart' as http;
import 'package:mobile/utils/app_utils.dart';

import '../models/article.dart';

class ArticlesProvider extends ChangeNotifier {
  final List<Article> _allArticles = [];

  UnmodifiableListView<Article> get allArticles => UnmodifiableListView(_allArticles);

  void fetchArticles() async {
    final response = await http.get(Uri.parse(AppUtils.apiUrl + AppUtils.articles));
    final json = jsonDecode(response.body);

    for (var article in json['articles']){
      final articleLink = article['links']['self']['href'];

      final articleResponse = await http.get(Uri.parse(AppUtils.apiUrl + articleLink));
      final articleJson = jsonDecode(articleResponse.body);

      _allArticles.insert(0, Article.fromJson(articleJson));
    }

    print(_allArticles);
    notifyListeners();
  }
}