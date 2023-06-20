// classe définissant les articles
class Article {
  final int id;
  final String titre;
  final String resume;
  final String contenu;
  final DateTime dateCreation;
  String categorie;
  String auteur;
  String image;

  // constructeur qui initialise tout sauf l'auteur, l'image et la catégorie
  Article({
    required this.id,
    required this.titre,
    required this.resume,
    required this.contenu,
    required this.dateCreation,
    this.auteur = "",
    this.image = "",
    this.categorie = ""
  });

  // change l'auteur
  void setAuteur(String nom){
    auteur = nom;
  }

  // change le lien de l'image
  void setImage(String lienImage){
    image = lienImage;
  }

  // change la catégorie
  void setCategorie(String nomCategorie){
    categorie = nomCategorie;
  }

  // crée un article depuis un objet json
  factory Article.fromJson(Map<String, dynamic> json){
    return Article(
      id: json['id'],
      titre: json['titre'],
      resume: json['resume'],
      contenu: json['contenu'],
      dateCreation: json['date_creation']
    );
  }
}