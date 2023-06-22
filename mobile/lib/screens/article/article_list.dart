import 'package:flutter/material.dart';
import 'package:mobile/utils/app_utils.dart';

import '../../models/article.dart';
import 'article_preview.dart';

class ArticleList extends StatelessWidget {
  // liste locale d'articles
  final List<Article> articles;

  // constructeur qui prend une liste d'articles en paramètres
  const ArticleList({super.key, required this.articles});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: <Widget>[
        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Padding(
              padding: const EdgeInsets.only(right: 10),
              child: FloatingActionButton.small(
                backgroundColor: AppUtils.primaryBackground,
                onPressed: () {},
                child: const Icon(Icons.arrow_downward),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(left: 10),
              child: FloatingActionButton.small(
                backgroundColor: AppUtils.primaryBackground,
                onPressed: () {},
                child: const Icon(Icons.arrow_upward),
              ),
            ),
          ],
        ),
        Expanded(
          // construit la vue des articles
          child: ListView.builder(
              itemCount: articles.length,
              itemBuilder: (BuildContext context, int index) {
                // construit pour chaque article sa preview
                return ArticlePreview(article: articles[index]);
              }),
        )
      ],
    );
  }
}
