import 'package:flutter/material.dart';
import 'package:mobile/screens/article/categorie_articles.dart';
import 'package:mobile/utils/app_utils.dart';

import '../../models/categorie.dart';

class CategorieChip extends StatelessWidget {
  final Categorie categorie;

  const CategorieChip({super.key, required this.categorie});

  Widget buildNewPage(BuildContext context){
    return Scaffold(
      appBar: AppBar(
        backgroundColor: AppUtils.primaryBackground,
        title: Text('Catégorie ${categorie.nom}'),
      ),
      body: CategorieArticles(categorie: categorie),
    );
  }

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
                return buildNewPage(context); // Appelle la fonction pour obtenir la nouvelle page
              },
            );
          }),
        );
      },
    );
  }
}
