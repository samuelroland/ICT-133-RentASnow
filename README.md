![introBanner](imgIntroReadme.PNG)

# Repository ICT-133-RentASnow

Pour la suite du module, vous allez développer une application en PHP sans base de données pour un site de location de snows (RentASnow). Pour ce faire, vous allez utiliser un ***template*** déjà existant.

Il est important de garder la structure proposée car elle répond à des normes qui permettent de programmer votre site de façon plus professionnelle.
Le template en question utilise déjà Boostrap ce qui implique que vous pouvez utiliser les classes existantes sans souci.

Pour travailler proprement, vous allez créer un repository personnel et dédié à ce sujet précis. Voici la procédure à suivre pour initialiser votre environnement de travail:

1. Ouvrez une console (`cmder` de préférence), tapez `npm -v`. Si la commande n'est pas reconnue, installez npm sur votre machine
2. Copiez ce repository dans votre compte Github **en vous servant du bouton 'Fork' sur Github.com**. Ne faites pas de clone, ne téléchargez pas le ZIP, ne copiez pas à partir d'un camarade, cela vous causera certainement des problèmes plus tard.
3. Clonez la copie que vous venez de faire sur votre PC
4. De retour à l'invite de commande, placez-vous dans le dossier de votre repository local et exécutez `npm install`

Vous voilà prêt à travailler!

Vous **devez** ajouter les fonctionnalités suivantes :

- Ajouter une page qui affiche la liste des snowboards du magasin. Pour chaque snowboard, on a l'indication s'il est actuellement loué ou pas. Cette liste doit être lue d'un fichier JSON, de la même manière que les news de la page d'accueil
- Ajouter une page qui permet de voir les détails d'un snowboard que l'utilisateur a cliqué dans la liste
- Réaliser un login: une page permet d'introduire son nom et mot de passe dans un formulaire. Quand le formulaire est envoyé, le site retrouve l'utilisateur par le nom et vérifie le mot de passe. S'il y a correspondance, l'utilisateur est enregistré dans la SESSION. La liste des utilisateurs/mots de passe doivent être stockés dans un fichier JSON
- Si l'utilisateur connecté est employé du magasin, il peut modifier l'indication 'loué ou pas' d'un snowboard à partir de sa page de détail
- Un fichier de log enregistre toutes les tentatives de connexions

Si vous avez encore du temps vous **pouvez** ajouter l'une l'autre des fonctionnalités suivantes :

- Inclure le calendrier réalisé précédemment, en mettant en évidence les jours de fermeture du magasin. Ces jours doivent être lus d'un fichier JSON
- Si l'utilisateur connecté est employé du magasin, il peut modifier les informations d'un snowboard à partir de sa page de détail
- Si l'utilisateur connecté est employé du magasin, il peut ajouter un nouveau snowboard
- Toute autre bonne idée personnelle (à valider avec le prof au préalable)
