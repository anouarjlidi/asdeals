<?php

namespace SA\CoreBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SA\CoreBundle\Entity\Admin;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
	  /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userAdmin = new Admin();
        $userAdmin->setEmailAddress("anouarjlidi@gmail.com");
        $plainPassword = 'anouar';
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($userAdmin, $plainPassword);
        $userAdmin->setPassword($encoded);
        $userAdmin->setRole('ROLE_ADMIN');

        $manager->persist($userAdmin);
        $manager->flush();
    }
}