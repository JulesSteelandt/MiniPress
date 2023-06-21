import 'package:flutter/material.dart';
import 'package:mobile/screens/article/categorie_articles.dart';

import '../../models/categorie.dart';

class CategorieChip extends StatelessWidget {
  final Categorie categorie;

  const CategorieChip({super.key, required this.categorie});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      child: Chip(
        backgroundColor: Colors.lightGreen,
        label: Text(
          categorie.nom,
          style: const TextStyle(
            color: Colors.white,
            fontSize: 20,
          ),
        ),
      ),
      onTap: (){
        Navigator.push(
            context,
            MaterialPageRoute(
                builder: (context) => CategorieArticles(categorie: categorie)
            )
        );
      },
    );
  }
}
