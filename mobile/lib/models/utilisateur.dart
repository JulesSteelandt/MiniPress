// classe pour un utilisateur
class Utilisateur{
  final int id;
  final String nom;
  final String prenom;

  // construit un utilisateur
  Utilisateur({required this.id, required this.nom, required this.prenom});

  // construit un utilisateur depuis un objet json
  factory Utilisateur.fromJson(Map<String, dynamic> json){
    return Utilisateur(id: json['id'], nom: json['nom'], prenom: json['prenom']);
  }
}