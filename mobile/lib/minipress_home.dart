import 'package:flutter/material.dart';
import 'package:mobile/providers/articles_provider.dart';
import 'package:mobile/providers/categories_provider.dart';
import 'package:mobile/screens/article_list.dart';
import 'package:mobile/screens/categorie_list.dart';
import 'package:provider/provider.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<StatefulWidget> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {
  @override
  void initState() {
    super.initState();
    Provider.of<ArticlesProvider>(context, listen: false).fetchArticles();
    Provider.of<CategoriesProvider>(context, listen: false).fetchCategories();
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'MiniPress App',
      home: Scaffold(
          appBar: AppBar(
            backgroundColor: Colors.lightGreen,
            title: const Text('MiniPress App'),
          ),
          body: Consumer2<ArticlesProvider, CategoriesProvider>(
            builder: (context, articlesProvider, categoriesProvider, child) {
              if (articlesProvider.allArticles.isEmpty ||
                  categoriesProvider.allCategories.isEmpty) {
                return Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: <Widget>[
                      const Text(
                        'Chargement des articles',
                        textAlign: TextAlign.center,
                        style:
                            TextStyle(color: Colors.lightGreen, fontSize: 40),
                      ),
                      const SizedBox(
                        height: 80,
                      ),
                      Transform.scale(
                        scale: 4.0,
                        child: const CircularProgressIndicator(
                          backgroundColor: Colors.lightGreenAccent,
                          color: Colors.green,
                          strokeWidth: 4,
                        ),
                      ),
                    ],
                  ),
                );
              } else {
                return Column(
                  children: <Widget>[
                    CategorieList(categories: categoriesProvider.allCategories),
                    Expanded(
                        child: ArticleList(articles: articlesProvider.allArticles),
                    ),
                  ],
                );
              }
            },
          )),
    );
  }
}
