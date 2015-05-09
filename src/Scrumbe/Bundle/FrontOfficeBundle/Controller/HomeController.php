<?php

namespace Scrumbe\Bundle\FrontOfficeBundle\Controller;

use Scrumbe\Bundle\UserBundle\Form\Type\UserType;
use Scrumbe\Models\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('scrumbe_get_projects'));
        }

        $session = $request->getSession();
        $error['signinForm'] = $session->getFlashBag()->get('postUserErrors');

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error['loginForm'] = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error['loginForm'] = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        $user = new User();
        if ($session->getFlashBag()->has('postUserValues'))
        {
            $signinValues = $session->getFlashBag()->get('postUserValues');
            $user->fromArray($signinValues, \BasePeer::TYPE_FIELDNAME);
        }

        $signinForm = $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('scrumbe_post_user')
        ));

        return $this->render('ScrumbeFrontOfficeBundle:Home:index.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'signinForm'    => $signinForm->createView(),
            'errors'         => $error
        ));
    }

    public function scrumAction(Request $request)
    {
        $session = $request->getSession();

        $signinForm = $this->createForm(new UserType(), null, array(
            'action' => $this->generateUrl('scrumbe_post_user')
        ));

        return $this->render('ScrumbeFrontOfficeBundle:Home:scrum.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'signinForm'    => $signinForm->createView()
        ));
    }

    public function offresAction(Request $request)
    {
        $session = $request->getSession();

        $signinForm = $this->createForm(new UserType(), null, array(
            'action' => $this->generateUrl('scrumbe_post_user')
        ));

        return $this->render('ScrumbeFrontOfficeBundle:Home:offres.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'signinForm'    => $signinForm->createView()
        ));
    }

    public function aboutAction(Request $request)
    {
        $session = $request->getSession();

        $signinForm = $this->createForm(new UserType(), null, array(
            'action' => $this->generateUrl('scrumbe_post_user')
        ));

        return $this->render('ScrumbeFrontOfficeBundle:Home:about-us.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'signinForm'    => $signinForm->createView()
        ));
    }

    public function contactAction(Request $request)
    {
        $session = $request->getSession();

        $signinForm = $this->createForm(new UserType(), null, array(
            'action' => $this->generateUrl('scrumbe_post_user')
        ));

        return $this->render('ScrumbeFrontOfficeBundle:Home:contact.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'signinForm'    => $signinForm->createView()
        ));
    }
}
