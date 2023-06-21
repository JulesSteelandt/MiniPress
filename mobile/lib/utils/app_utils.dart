// stocke les utilitaires de l'appli
import 'package:flutter/material.dart';

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
}