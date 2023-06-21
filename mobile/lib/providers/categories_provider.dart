import 'dart:collection';
import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:http/http.dart' as http;

import '../models/categorie.dart';
import '../utils/app_utils.dart';

class CategoriesProvider extends ChangeNotifier {
  // liste locale des catégories
  final List<Categorie> _allCategories = [];

  // getter de la liste de catégories
  UnmodifiableListView<Categorie> get allCategories => UnmodifiableListView(_allCategories);

  // récupère tous les articles et les stocke en local
  void fetchCategories() async {
    // récupère les articles et convertit en json
    final response = await http.get(Uri.parse(AppUtils.apiUrl + AppUtils.categories));
    final json = jsonDecode(response.body);

    // pour chaque article de la liste
    for (var categorie in json['categories']){
      // ajoute à la liste le json converti en article
      _allCategories.insert(0, Categorie.fromJson(categorie['categorie']));
    }
    // notifie les widgets branchés sur le provider
    notifyListeners();
  }
}