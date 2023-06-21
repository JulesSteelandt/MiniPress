import 'package:flutter/material.dart';
import 'package:mobile/screens/article/categorie_articles.dart';
import 'package:mobile/utils/app_utils.dart';

import '../../models/categorie.dart';

class CategorieChip extends StatelessWidget {
  final Categorie categorie;

  const CategorieChip({super.key, required this.categorie});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      child: Chip(
        backgroundColor: AppUtils.primaryBackground,
        label: Text(
          categorie.nom,
          style: const TextStyle(
            color: AppUtils.primaryTextColor,
            fontSize: 20,
          ),
        ),
      ),
      onTap: (){
        Navigator.push(
          context,
          MaterialPageRoute(builder: (BuildContext context) {
            return Builder(
              builder: (BuildContext context) {
                // crée le widget d'affichage
                final CategorieArticles categorieArticles = CategorieArticles(categorie: categorie);
                // Appelle la fonction pour obtenir la nouvelle page
                return AppUtils.buildNewPage(context, 'Categorie ${categorie.nom}', categorieArticles);
              },
            );
          }),
        );
      },
    );
  }
}
