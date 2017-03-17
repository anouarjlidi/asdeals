<?php

namespace SA\CoreBundle\Controller\Security;

use SA\CoreBundle\Entity\Admin;
use SA\CoreBundle\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin")
 */
class AdminSecurityController extends Controller
{
    /**
     * @Route("/login", name="app_admin_login")
     * @Method("GET")
     */
    public function loginAction() : Response
    {
    	$securityUtils = $this->get('security.authentication_utils');
    	$form = $this->get('form.factory')->createNamed(
            '',
            LoginType::class,
            [
                '_admin_email' => $securityUtils->getLastUsername(),
            ],
            [
                'username_parameter' => '_admin_email',
                'password_parameter' => '_admin_password',
                'csrf_field_name' => '_admin_csrf',
                'csrf_token_id' => 'authenticate_admin',
            ]
        );
        /*$product = new Admin();
    $product->setEmailAddress("anouarjlidi@gmail.com");
    $product->setPassword("anouar");
    $product->setRole('ROLE_ADMIN');

    $em = $this->getDoctrine()->getManager();

    // tells Doctrine you want to (eventually) save the Product (no queries yet)
    $em->persist($product);

    // actually executes the queries (i.e. the INSERT query)
    $em->flush();

    return new Response('Saved new product with id '.$product->getId());*/
        return $this->render('CoreBundle:AdminSecurity:login.html.twig', [
            'form' => $form->createView(),
            'error' => $securityUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * @Route("/login", name="app_admin_login_check")
     * @Method("POST")
     */
    public function loginCheck()
    {
    }

    /**
     * @Route("/login", name="app_admin_logout")
     * @Method("POST")
     */
    public function logout()
    {
    }

}
