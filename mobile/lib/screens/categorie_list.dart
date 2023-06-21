import 'package:flutter/material.dart';

import '../models/categorie.dart';

class CategorieList extends StatelessWidget {
  // liste locale de catégories
  final List<Categorie> categories;

  // constructeur prenant en paramètres une liste de catégories
  const CategorieList({super.key, required this.categories});

  @override
  Widget build(BuildContext context) {
    // affiche les catégories sous forme de puces
    return Row(
      children: [
        Expanded(
          child: SingleChildScrollView(
            scrollDirection: Axis.horizontal,
            child: Wrap(
              children: List.generate(categories.length, (index) {
                return Padding(
                  padding: const EdgeInsets.all(4.0),
                  child: Chip(
                    backgroundColor: Colors.greenAccent,
                    label: Text(
                      categories[index].nom,
                      style: const TextStyle(
                        fontSize: 20,
                      ),
                    ),
                  ),
                );
              }),
            ),
          ),
        ),
        // s'il y a plus de 2 catégories
        if (categories.length > 3)
          // affiche une flèche pour montrer que le scroll est possible
          const Icon(Icons.arrow_forward),
      ],
    );
  }
}

