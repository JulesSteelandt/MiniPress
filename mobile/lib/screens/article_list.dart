import 'package:flutter/cupertino.dart';

import '../models/article.dart';
import 'article_preview.dart';

class ArticleList extends StatelessWidget {
  final List<Article> articles;

  const ArticleList({super.key, required this.articles});

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
        itemCount: articles.length,
        itemBuilder: (BuildContext context, int index) {
          return ArticlePreview(article: articles[index]);
        });
  }
}
