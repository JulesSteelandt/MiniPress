import 'package:flutter/cupertino.dart';
import 'package:mobile/providers/categories_provider.dart';
import 'package:mobile/screens/loading/loading.dart';
import 'package:provider/provider.dart';

import '../../models/categorie.dart';
import '../article/article_list.dart';

// widget pour afficher la liste des articles d'une catégorie
class CategorieArticles extends StatefulWidget {
  // la catégorie du widget
  final Categorie categorie;

  // construit le widget avec la catégorie en paramètres
  const CategorieArticles({super.key, required this.categorie});

  // crée le state de ce widget
  @override
  State<StatefulWidget> createState() => _CategorieArticlesState();
}

// state du widget
class _CategorieArticlesState extends State<CategorieArticles>{
  @override
  void initState() {
    super.initState();
    // au lancement du widget on récupère les articles
    Provider.of<CategoriesProvider>(context, listen: false).fetchCurrentCategorieArticles(widget.categorie);
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<CategoriesProvider>(
        builder: (context, provider, child){
          // si la liste est vide (donc en chargement)
          if (provider.currentCategorieArticles.isEmpty){
            // retourne un chargement
            return Loading(titre: 'Chargement des articles de ${widget.categorie.nom}');
          } else {
            // sinon affiche les articles
            return ArticleList(
              articles: provider.currentCategorieArticles,
              callback: provider.orderArticles,
            );
          }
        }
    );
  }
}