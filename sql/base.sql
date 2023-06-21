-- Table "categorie"
CREATE TABLE categorie
(
    id  INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255)
);

-- Table "utilisateurs"
CREATE TABLE utilisateur
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    email            VARCHAR(255),
    mot_de_passe     VARCHAR(255),
    nom              VARCHAR(255),
    prenom           VARCHAR(255),
    statut           int(3)
);

-- Table "article"
CREATE TABLE article
(
    id               INT PRIMARY KEY AUTO_INCREMENT,
    titre            VARCHAR(255),
    resume           VARCHAR(255),
    contenu          TEXT,
    categorie_id     INT,
    auteur           INT,
    date_creation    DATETIME,
    date_publication DATETIME,
    image            VARCHAR(255),
    FOREIGN KEY (categorie_id) REFERENCES categorie (id),
    FOREIGN KEY (auteur) REFERENCES utilisateur (id)
);

INSERT INTO utilisateur values (1, 'user1@mail.com','$2y$10$wpmkRKMEvVmFLDWZcENR4et2vz8v9gjm4hQT8VB5TV6cGuIlBLzMG','user1','leGoat', 2);
INSERT INTO utilisateur values (2, 'user2@mail.com','$2y$10$3c/O.sP/rpT/A5zxgDQBZuL5Vpo6MyH0IUnoWo1Bjpvxb/XqCEGgq','user2','Magic', 1);
INSERT INTO utilisateur values (3, 'maxime.bg@mail.com','$2y$10$6LDVQwJAYFXWqkTrKSMkK.rs3G30qVScIAgnCuXQsCw6Po515j/9K','Maxime','Biaggi', 1);

INSERT INTO categorie values (1,'Sport');
INSERT INTO categorie values (2,'Jeux vidéo');
INSERT INTO categorie values (3,'Divertissement');


INSERT INTO article VALUES (1, 'La Boogie bomb de retour sur Fortnite ?', 'Après une année des rumeurs tournent sur son retour dans le jeu légendaire ! \n\n Il faut écrire 30 mots donc je m''en approche ça va on y est bientôt voilà gg à tous', 'Pendant l’événement de Noël sur Fortnite, la fête hivernale, redécouvrez chaque jour un item qui a été remisé par le passé. \n\n L''occasion pour les nostalgiques de se remémorer un ancien gameplay. Attention cependant : l''arme n''est disponible que pendant 24 heures, suite à quoi, elle sera de nouveau remisée et laissera sa place à une nouvelle. Disponible en version rare La bombe boogie-woogie fonctionne comme une grenade : lancez-la sur vos ennemis pour les faire danser et les rendre inoffensifs ! \n\n Attention cependant : aux premiers dégâts qu''ils recevront, ils ne seront plus bloqués.', 2, '1', '2023-06-15 12:17:16', NULL, '');
INSERT INTO article VALUES (2, 'Billy qui imite Homer', '## histoire d''un donut au sucre', '## Marge  \n\n peut tu apporter  \n\n mon donut sucré  \n\n au sucre', 3, '2', '2023-06-16 09:30:00', '2023-06-16 15:45:12', '');
INSERT INTO article VALUES (3, 'Jeux video ou quoi', '# Tellure est pluvio cortice ferrumque insiluit satus  \n\n Color telaque dumque ', '# Lorem ipsum dolor sit amet, consectetur adipiscing elit. ## Vestibulum sit amet lectus eget sapien porta lacinia. Aliquam mi massa, convallis ac dolor at, aliquet placerat est. Maecenas euismod, libero nec tincidunt convallis, \n\n   turpis dui malesuada metus, facilisis suscipit arcu nisl quis neque. Quisque molestie odio vel arcu interdum, aliquam tincidunt lorem faucibus. Aliquam vestibulum eros quam, in convallis urna rutrum ut. Fusce non arcu nisi. Nunc ante orci, eleifend ut.', 2, '1', '2023-06-17 18:00:00', NULL, '');
INSERT INTO article VALUES (4, 'l''article le plus neutre de la terre du sport', '# Fortis teque manus movit crura \n\n Appellat sui', '# Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mauris ipsum, finibus quis ## lectus et, pulvinar commodo turpis. Nulla dictum efficitur odio tincidunt convallis. \n\n Proin vehicula, lectus sit amet ultrices euismod, dolor urna vehicula tellus, at rutrum ante velit eget orci. Duis mollis sem felis, eu rutrum tellus \n\n vestibulum eget. Mauris purus neque, feugiat et lacus id, condimentum efficitur augue. Pellentesque vel posuere odio. Nam mattis posuere massa. Sed convallis.', 1, '1', '2023-06-18 10:05:30', NULL, '');
INSERT INTO article VALUES (5, 'Le meme de squeezie', '## est ce que c est bon pour vous', 'eske  \n\n eske  \n\n eske  \n\n c''est bon pour vous', 3, '3', '2023-06-19 14:20:00', NULL, '');
INSERT INTO article VALUES (6, 'Nadal se fait 1v1 sur le terrain de Tenis par un enfant de 5 ans', '## Il a gagné, \n\n le monde est choqué', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lacus nibh, auctor in tortor quis, ultrices sollicitudin erat. Cras ipsum nunc, aliquet ut nibh vel, tempor ultricies ex. Sed sit amet \n\n ligula nisi. Fusce ex sapien \n\n vestibulum in arcu eget, pellentesque posuere metus. Pellentesque consectetur nulla nec urna ultrices, nec pulvinar ipsum aliquam. Sed maximus a neque id porta. Sed dui justo, mattis in enim et, rhoncus interdum ante. Fusce.', 1, '1', '2023-06-20 08:45:00', '2023-06-20 12:30:22', '');
INSERT INTO article VALUES (7, 'On est divertit', '# Miletida ante Cadmus  \n\n Hamos nunc illuc', '##  Lorem ipsum dolor sit amet, consectetur adipiscing elit. \n\n Duis iaculis pulvinar sem sed posuere. Sed lobortis ultrices ex, ut dignissim mauris finibus in. Nunc maximus nibh a posuere tincidunt. Vestibulum pretium, dui id pellentesque semper, ante tellus sodales leo, eget ultrices nulla massa a sapien. \n\n Praesent non commodo augue. In id odio convallis, rutrum justo vitae, interdum arcu. Vestibulum faucibus euismod ex, id placerat urna. Nunc rutrum elit ut enim.', 3, '2', '2023-06-15 17:30:00', '2023-06-15 19:15:48', '');
INSERT INTO article VALUES (8, 'On fait du sport', '# Et iuventam  \n\n Et sed pennis  Lorem', '## Lorem ipsum dolor sit amet, consectetur adipiscing elit. \n\n Sed ut est at urna tempus venenatis non sed risus. Nulla volutpat tellus ac sapien ## maximus, sit amet tincidunt justo elementum. Aliquam hendrerit finibus ultricies. Phasellus ipsum enim, facilisis non dignissim vel, fringilla id arcu. Mauris rhoncus massa ut scelerisque viverra. Mauris malesuada vitae mauris vitae porttitor. Sed mi eros, sagittis et molestie vel, efficitur eu leo. Duis dignissim massa ac nisl.', 1, '2', '2023-06-16 11:20:00', '2023-06-16 14:35:10', '');
