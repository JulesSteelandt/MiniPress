import 'package:flutter/cupertino.dart';
import 'package:mobile/providers/categories_provider.dart';
import 'package:mobile/screens/loading/loading.dart';
import 'package:provider/provider.dart';

import '../../models/categorie.dart';
import 'article_list.dart';

class CategorieArticles extends StatelessWidget {
  final Categorie categorie;

  const CategorieArticles({super.key, required this.categorie});

  @override
  Widget build(BuildContext context) {
    return Consumer<CategoriesProvider>(
        builder: (context, provider, child){
          provider.fetchCurrentCategorieArticles(categorie);

          if (provider.currentCategorieArticles.isEmpty){
            return Loading(titre: 'Chargement des articles de ${categorie.nom}');
          } else {
            return ArticleList(articles: provider.currentCategorieArticles);
          }
        }
    );
  }
}