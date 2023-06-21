import 'package:flutter/cupertino.dart';
import 'package:flutter_markdown/flutter_markdown.dart';
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
    return SingleChildScrollView( // Wrap the entire content in a SingleChildScrollView
      child: Center(
        child: Column(
          children: <Widget>[
            Text(article.titre),
            Text(DateFormat.yMd('fr_FR').format(article.dateCreation)),
            MarkdownBody(data: article.resume),
            MarkdownBody(data: article.contenu),
            Text('${article.auteur?.nom} ${article.auteur?.prenom}'),
          ],
        ),
      ),
    );
  }
}