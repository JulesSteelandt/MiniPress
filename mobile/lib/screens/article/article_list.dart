import 'package:easy_search_bar/easy_search_bar.dart';
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
  // liste d'articles utilisée pour la recherche
  List<Article> articlesToUse = [];

  @override
  void initState() {
    super.initState();
    // copie la liste du widget dans la liste de recherche
    articlesToUse = widget.articles;
  }

  // trie les articles selon un ordre donné
  void orderArticles(TriOrdre ordre){
    setState(() {
      widget.callback(ordre);
    });
  }

  // gère la recherche d'un article
  void onSearch(String value) {
    setState(() {
      // filtre la liste sur le titre des articles
      articlesToUse = widget.articles.where((element) {
        return element.titre.toLowerCase().contains(value.toLowerCase()) ||
            element.resume.toLowerCase().contains(value.toLowerCase());
      }).toList();
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
            Padding(
              padding: const EdgeInsets.only(left: 10),
              child: SizedBox(
                width: 250,
                height: 50,
                child: EasySearchBar(
                  title: const Text(
                      'Recherche',
                    style: TextStyle(color: AppUtils.primaryTextColor),
                  ),
                  iconTheme: const IconThemeData(
                    color: AppUtils.primaryTextColor
                  ),
                  backgroundColor: AppUtils.primaryBackground,
                  onSearch: onSearch,
                ),
              )
            ),
          ],
        ),
        Expanded(
          // construit la vue des articles
          child: ListView.builder(
              itemCount: articlesToUse.length,
              itemBuilder: (BuildContext context, int index) {
                // construit pour chaque article sa preview
                return ArticlePreview(article: articlesToUse[index]);
              }),
        )
      ],
    );
  }
}
