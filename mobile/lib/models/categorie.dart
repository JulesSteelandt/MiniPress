// classe pour une catégorie
class Categorie {
  final int id;
  final String nom;

  // constructeur de catégorie
  const Categorie({required this.id, required this.nom});

  // construit une catégorie depuis un objet json
  factory Categorie.fromJson(Map<String, dynamic> json){
    return Categorie(id: json['id'], nom: json['nom']);
  }
}