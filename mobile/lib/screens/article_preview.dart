import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

import '../models/article.dart';

class ArticlePreview extends StatelessWidget {
  final Article article;

  const ArticlePreview({super.key, required this.article});

  @override
  Widget build(BuildContext context) {
    return Card(
      child: ListTile(
        leading: const Icon(Icons.import_contacts_sharp),
        title: Text(article.titre),
        subtitle: Text(DateFormat.yMd('fr_FR').format(article.dateCreation)),
        trailing: Text('${article.auteur?.nom} ${article.auteur?.prenom}'),
      )
    );
  }
}