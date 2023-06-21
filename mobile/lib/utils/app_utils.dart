import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

import '../models/article.dart';
import '../models/utilisateur.dart';

// stocke les utilitaires de l'appli
class AppUtils {
  // url de l'api
  static const String apiUrl = 'http://docketu.iutnc.univ-lorraine.fr:17012';

  // url de la liste des catégories dans l'api
  static const String categories = '/api/categories/';

  // url de la liste des articles dans l'api
  static const String articles = '/api/articles/';

  // url de la liste des auteurs dans l'api
  static const String auteurs = '/api/auteurs/';

  // couleur de fond de l'appli
  static const Color primaryBackground = Colors.lightGreen;

  // couleur de fond alternative de l'appli
  static const Color secondaryBackground = Colors.green;

  // couleur de texte de l'appli
  static const Color primaryTextColor = Colors.white;

  // récupère l'auteur pour chaque article
  static Future<void> fetchAuteurForArticles(List<Article> articles) async {
    // pour chaque article de la liste
    for (var article in articles){
      // récupère l'auteur et le converti en json
      final response = await http.get(Uri.parse('${AppUtils.apiUrl}${AppUtils.auteurs}${article.auteurId}/'));
      final json = jsonDecode(response.body);

      // transforme le json en utilisateur
      final Utilisateur auteur = Utilisateur.fromJson(json['user']['user']);

      // change l'auteur de l'article
      article.setAuteur(auteur);
    }
  }

  // affiche une nouvelle page avec pour enfant le widget des paramètres
  static Widget buildNewPage(BuildContext context, String titleText, Widget display){
    return Scaffold(
      appBar: AppBar(
        backgroundColor: AppUtils.primaryBackground,
        title: Text(titleText),
      ),
      body: display,
    );
  }
}