import 'package:flutter/material.dart';
import 'package:mobile/providers/articles_provider.dart';
import 'package:mobile/providers/categories_provider.dart';
import 'package:mobile/screens/article/article_list.dart';
import 'package:mobile/screens/categorie/categorie_list.dart';
import 'package:mobile/screens/loading/loading.dart';
import 'package:mobile/utils/app_utils.dart';
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
      debugShowCheckedModeBanner: false,
      title: 'MiniPress App',
      home: Scaffold(
          appBar: AppBar(
            backgroundColor: AppUtils.primaryBackground,
            title: const Text('MiniPress App'),
          ),
          body: Consumer2<ArticlesProvider, CategoriesProvider>(
            builder: (context, articlesProvider, categoriesProvider, child) {
              if (articlesProvider.allArticles.isEmpty || categoriesProvider.allCategories.isEmpty) {
                return const Loading(titre: 'Chargement des articles');
              } else {
                return Column(
                  children: <Widget>[
                    CategorieList(categories: categoriesProvider.allCategories),
                    Expanded(
                        child: ArticleList(
                          articles: articlesProvider.allArticles,
                          callback: articlesProvider.orderArticles,
                        ),
                    ),
                  ],
                );
              }
            },
          )),
    );
  }
}
