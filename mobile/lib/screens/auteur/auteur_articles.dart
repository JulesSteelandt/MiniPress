import 'package:flutter/cupertino.dart';
import 'package:mobile/models/utilisateur.dart';
import 'package:mobile/providers/auteur_provider.dart';
import 'package:mobile/screens/article/article_list.dart';
import 'package:mobile/screens/loading/loading.dart';
import 'package:provider/provider.dart';

// widget pour afficher les articles d'un auteur
class AuteurArticles extends StatefulWidget {
  // l'auteur des articles
  final Utilisateur auteur;

  // construit le widget avec l'auteur en paramètres
  const AuteurArticles({super.key, required this.auteur});

  @override
  State<StatefulWidget> createState() => _AuteurArticlesState();
}

// state du widget
class _AuteurArticlesState extends State<AuteurArticles>{
  @override
  void initState() {
    super.initState();
    // récupère les articles de l'auteur
    Provider.of<AuteurProvider>(context, listen: false).fetchArticlesByAuteur(widget.auteur);
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<AuteurProvider>(
        builder: (context, provider, child){
          if (provider.auteurArticles.isEmpty){
            // si la liste est vide, affiche un chargement
            return Loading(titre: "Chargement des articles de ${widget.auteur.nom} ${widget.auteur.prenom}");
          } else {
            // sinon affiche les articles
            return ArticleList(
              articles: provider.auteurArticles,
              callback: provider.orderArticles,
            );
          }
        }
    );
  }
}