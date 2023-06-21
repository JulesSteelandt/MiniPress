import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:mobile/screens/article/article_details.dart';

import '../../models/article.dart';
import '../../utils/app_utils.dart';

class ArticlePreview extends StatelessWidget {
  final Article article;

  const ArticlePreview({super.key, required this.article});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      child: Card(
          child: ListTile(
            leading: const Icon(Icons.import_contacts_sharp),
            title: Text(article.titre),
            subtitle: Text(DateFormat.yMd('fr_FR').format(article.dateCreation)),
            trailing: Text('${article.auteur?.nom} ${article.auteur?.prenom}'),
          )
      ),
      onTap: (){
        if (article.id == -1) {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              backgroundColor: AppUtils.primaryBackground,
              content: Text(
                  "Cet article n'est pas consultable",
                style: TextStyle(
                  color: AppUtils.primaryTextColor,
                  fontSize: 20
                ),
              ),
            ),
          );
        } else {
          Navigator.push(
            context,
            MaterialPageRoute(builder: (BuildContext context) {
              return Builder(
                builder: (BuildContext context) {
                  // crée le widget d'affichage
                  final ArticleDetails articleDetails = ArticleDetails(article: article);
                  // Appelle la fonction pour obtenir la nouvelle page
                  return AppUtils.buildNewPage(context, article.titre, articleDetails);
                },
              );
            }),
          );
        }
      },
    );
  }
}