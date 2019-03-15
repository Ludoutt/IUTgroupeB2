<?php

namespace App\DataFixtures;

use App\Entity\Backlog;
use App\Entity\Element;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $backlog = new Backlog();
        $backlog->setTitle("Application Lambda");
        $manager->persist($backlog);

        $manager->flush();

        $user = new User();
        $user->setEmail("po@po.com");
        $user->setName("Product Owner1");
        $user->setRoles(["ROLE_PRODUCT_OWNER"]);
        $user->setPassword($this->encoder->encodePassword($user, 'test'));
        $manager->persist($user);
        $manager->flush();

        $element = new Element();
        $element->setTitle("Connexion");
        $element->setDescription("En tant que membre inscrit, je peux me connecter via le formulaire de login afin d'accéder aux backlogs");
        $element->setType("User story");
        $element->setStatus("0");
//        $element->setPriority("4");
//        $element->setEstimation("");
//        $element->setListeCheck("");
        $element->setCriteresTests("Etant donné que je me suis déjà inscrit, quand je rentre mes identifiants et que je clique sur le bouton de connexion, alors je suis connecté et j'accède à la page d'accueil");
        $element->setBacklog($backlog);
        $element->setCreatedBy($user);
        $manager->persist($element);

        $manager->flush();

        $element = new Element();
        $element->setTitle("Déconnexion");
        $element->setDescription("En tant qu'utilisateur, je peux me déconnecter");
        $element->setType("User story");
        $element->setStatus("0");
//        $element->setPriority("3");
//        $element->setEstimation("");
//        $element->setListeCheck("");
        $element->setCriteresTests("à compléter");
        $element->setBacklog($backlog);
        $element->setCreatedBy($user);
        $manager->persist($element);

        $manager->flush();

        $element = new Element();
        $element->setTitle("Commande de produit");
        $element->setDescription("En tant que client, je peux régler le montant de mon panier afin de valider ma commande");
        $element->setType("User story");
        $element->setStatus("0");
//        $element->setPriority("3");
//        $element->setEstimation("");
//        $element->setListeCheck("");
        $element->setCriteresTests("Etant donné que j'ai ajouté des produits dans mon panier, quand je le valide, alors j'atteris sur une page me permettant de payer");
        $element->setBacklog($backlog);
        $element->setCreatedBy($user);
        $manager->persist($element);
        $manager->flush();


        $element = new Element();
        $element->setTitle("Utilisation d'un bon de réduction");
        $element->setDescription("En tant que client, quand je saisie mon bon de commande valide, alors il est appliqué et le prix de mon panier est réduit");
        $element->setType("User story");
        $element->setStatus("0");
//        $element->setPriority("2");
//        $element->setEstimation("2");
//        $element->setListeCheck("");
//        $element->setCriteresTests("");
        $element->setBacklog($backlog);
        $element->setCreatedBy($user);
        $manager->persist($element);
        $manager->flush();

        $element = new Element();
        $element->setTitle("Recherche de produit");
        $element->setDescription("Je dois pouvoir rechercher des produits");
        $element->setType("User Story");
        $element->setStatus("0");
//        $element->setPriority("0");
//        $element->setEstimation("");
//        $element->setListeCheck("");
//        $element->setCriteresTests("");
        $element->setBacklog($backlog);
        $element->setCreatedBy($user);
        $manager->persist($element);
        $manager->flush();
    }
}
