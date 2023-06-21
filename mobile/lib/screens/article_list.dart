import 'package:flutter/cupertino.dart';

import '../models/article.dart';
import 'article_preview.dart';

class ArticleList extends StatelessWidget {
  // liste locale d'articles
  final List<Article> articles;

  // constructeur qui prend une liste d'articles en paramètres
  const ArticleList({super.key, required this.articles});

  @override
  Widget build(BuildContext context) {
    // construit la vue des articles
    return ListView.builder(
        itemCount: articles.length,
        itemBuilder: (BuildContext context, int index) {
          // construit pour chaque article sa preview
          return ArticlePreview(article: articles[index]);
        });
  }
}
