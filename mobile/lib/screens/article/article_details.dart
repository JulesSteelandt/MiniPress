import 'package:flutter/cupertino.dart';
import 'package:intl/intl.dart';

import '../../models/article.dart';

// widget d'affichage d'une article
class ArticleDetails extends StatelessWidget {
  // article à afficher
  final Article article;

  // construit le widget avec l'article entré en paramètres
  const ArticleDetails({super.key, required this.article});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: <Widget>[
        Text(article.titre),
        Text(DateFormat.yMd('fr_FR').format(article.dateCreation)),
        Text(article.resume),
        Text(article.contenu),
        Text('${article.auteur?.nom} ${article.auteur?.prenom}'),
      ],
    );
  }
}