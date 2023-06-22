import 'package:flutter/material.dart';
import 'package:mobile/utils/app_utils.dart';
import 'package:mobile/utils/tri_ordre.dart';

import '../../models/article.dart';
import 'article_preview.dart';

// widget d'affichage d'une liste d'articles
class ArticleList extends StatefulWidget {
  // liste locale d'articles
  final List<Article> articles;

  final Function(TriOrdre ordre) callback;

  // constructeur qui prend une liste d'articles en paramètres
  const ArticleList({super.key, required this.articles, required this.callback});

  @override
  State<StatefulWidget> createState() => _ArticleListState();
}

// state du widget
class _ArticleListState extends State<ArticleList> {
  void orderArticles(TriOrdre ordre){
    setState(() {
      widget.callback(ordre);
    });
  }

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
                onPressed: () {
                  orderArticles(TriOrdre.descendant);
                },
                child: const Icon(Icons.arrow_downward),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(left: 10),
              child: FloatingActionButton.small(
                backgroundColor: AppUtils.primaryBackground,
                onPressed: () {
                  orderArticles(TriOrdre.ascendant);
                },
                child: const Icon(Icons.arrow_upward),
              ),
            ),
          ],
        ),
        Expanded(
          // construit la vue des articles
          child: ListView.builder(
              itemCount: widget.articles.length,
              itemBuilder: (BuildContext context, int index) {
                // construit pour chaque article sa preview
                return ArticlePreview(article: widget.articles[index]);
              }),
        )
      ],
    );
  }
}
