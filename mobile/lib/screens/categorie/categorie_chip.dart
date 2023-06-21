import 'package:flutter/material.dart';

import '../../models/categorie.dart';

class CategorieChip extends StatelessWidget {
  final Categorie categorie;

  const CategorieChip({super.key, required this.categorie});

  @override
  Widget build(BuildContext context) {
    return Chip(
      backgroundColor: Colors.lightGreen,
      label: Text(
        categorie.nom,
        style: const TextStyle(
          color: Colors.white,
          fontSize: 20,
        ),
      ),
    );
  }
}