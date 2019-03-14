<?php

namespace App\DataFixtures;

use App\Entity\Backlog;
use App\Entity\Element;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $backlog = new Backlog();
        $backlog->setTitle("Application Lambda");
        $manager->persist($backlog);

        $manager->flush();

        $element = new Element();
        $element->setTitle("Connexion");
        $element->setDescription("En tant qu'utilisateur, quand je clique sur le bouton de connexion, alors je suis connecté et j'accède à mon profil");
        $element->setType("User story");
        $element->setStatus("1");
        $element->setPriority("4");
//        $element->setEstimation("");
//        $element->setListeCheck("");
//        $element->setCriteresTests("");
        $element->setBacklog($backlog);
        $manager->persist($element);

        $manager->flush();

        $element = new Element();
        $element->setTitle("Déconnexion");
        $element->setDescription("En tant qu'utilisateur, quand je clique sur le bouton de déconnexion, alors je suis déconnecté");
        $element->setType("User story");
        $element->setStatus("0");
        $element->setPriority("3");
//        $element->setEstimation("");
//        $element->setListeCheck("");
//        $element->setCriteresTests("");
        $element->setBacklog($backlog);
        $manager->persist($element);

        $manager->flush();

        $element = new Element();
        $element->setTitle("Commande de produit");
        $element->setDescription("En tant que client, quand je valide mon panier, alors j'atteris sur une page me permettant de payer");
        $element->setType("User story");
        $element->setStatus("1");
        $element->setPriority("3");
//        $element->setEstimation("");
//        $element->setListeCheck("");
//        $element->setCriteresTests("");
        $element->setBacklog($backlog);
        $manager->persist($element);
        $manager->flush();


        $element = new Element();
        $element->setTitle("Validation de compte");
        $element->setDescription("En tant que visiteur, quand je suis le lien de validation que j'ai reçu par email, alors mon compte est créé et je suis automatiquement connecté");
        $element->setType("User story");
        $element->setStatus("2");
        $element->setPriority("3");
        $element->setEstimation("1");
//        $element->setListeCheck("");
//        $element->setCriteresTests("");
        $element->setBacklog($backlog);
        $manager->persist($element);$manager->flush();

        $element = new Element();
        $element->setTitle("Utilisation d'un bon de réduction");
        $element->setDescription("En tant que client, quand je saisie mon bon de commande valide, alors il est appliqué et le prix de mon panier est réduit");
        $element->setType("User story");
        $element->setStatus("1");
        $element->setPriority("2");
        $element->setEstimation("2");
//        $element->setListeCheck("");
//        $element->setCriteresTests("");
        $element->setBacklog($backlog);
        $manager->persist($element);$manager->flush();

        $element = new Element();
        $element->setTitle("Recherche de produit");
        $element->setDescription("Je dois pouvoir rechercher des produits");
        $element->setType("Tech Story");
        $element->setStatus("0");
        $element->setPriority("0");
//        $element->setEstimation("");
//        $element->setListeCheck("");
//        $element->setCriteresTests("");
        $element->setBacklog($backlog);
        $manager->persist($element);$manager->flush();
    }
}
