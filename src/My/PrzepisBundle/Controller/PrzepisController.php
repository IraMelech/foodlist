<?php

namespace My\PrzepisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\PrzepisBundle\Entity\Przepis;
use My\PrzepisBundle\Entity\SkladnikPrzepisu;
use My\PrzepisBundle\Form\PrzepisType;

/**
 * Przepis controller.
 *
 * @Route("/przepis")
 */
class PrzepisController extends Controller
{
    /**
     * Lists all Przepis entities.
     *
     * @Route("/browse", name="przepis")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyPrzepisBundle:Przepis')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Przepis entity.
     *
     * @Route("/show/{slug}", name="przepis_show")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:Przepis')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Przepis entity.');
        }
        $deleteForm = $this->createDeleteForm($slug);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Przepis entity.
     *
     * @Route("/new", name="przepis_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Przepis();
        $form   = $this->createForm(new PrzepisType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Przepis entity.
     *
     * @Route("/create", name="przepis_create")
     * @Method("POST")
     * @Template("MyPrzepisBundle:Przepis:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Przepis();
        $form = $this->createForm(new PrzepisType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach ($entity->getSp() as $skladnik) {
                $skladnik->setPrzepis($entity);
            }
            foreach ($entity->getKrok() as $krok) {
                $krok->setPrzepis($entity);
            }
            foreach ($entity->getImage() as $image) {
                $image->setPrzepis($entity);

                $image->upload();
            }
            $entity->setUser($this->container->get('security.context')->getToken()->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('przepis_show', array('slug' => $entity->getSlug())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Przepis entity.
     *
     * @Route("/edit/{slug}", name="przepis_edit")
     * @Template()
     */
    public function editAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:Przepis')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Przepis entity.');
        }

        if (($this->container->get('security.context')->getToken()->getUser()->getId())==($entity->getUser()->getId()))
        {
                $editForm = $this->createForm(new PrzepisType(), $entity);
                $deleteForm = $this->createDeleteForm($slug);
        
                return array(
                    'entity'      => $entity,
                    'form'        => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                );
        }
        else{
            return $this->redirect($this->generateUrl('przepis'));
        }
    }

    /**
     * Edits an existing Przepis entity.
     *
     * @Route("/update/{slug}", name="przepis_update")
     * @Method("POST")
     * @Template("MyPrzepisBundle:Przepis:edit.html.twig")
     */
    public function updateAction(Request $request, $slug)
    {
        $orginalSp = array();


        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:Przepis')->findOneBySlug($slug);

        foreach ($entity->getSp() as $toRemove) {
            $em->remove($toRemove);
            $em->flush();
        }
        foreach ($entity->getKrok() as $toRemove) {
            $em->remove($toRemove);
            $em->flush();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Przepis entity.');
        }

        $deleteForm = $this->createDeleteForm($slug);
        $editForm = $this->createForm(new PrzepisType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            foreach ($entity->getSp() as $skladnik) {
                $skladnik->setPrzepis($entity);
            }
            foreach ($entity->getKrok() as $krok) {
                $krok->setPrzepis($entity);
            }
            $em->persist($entity);
            $em->flush();

            // return $this->redirect($this->generateUrl('przepis_edit', array('slug' => $slug)));
        }

        return array(
            'entity'      => $entity,
            'form'         => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Przepis entity.
     *
     * @Route("/delete/{slug}", name="przepis_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $slug)
    {
        $form = $this->createDeleteForm($slug);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyPrzepisBundle:Przepis')->findOneBySlug($slug);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Przepis entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('przepis'));
    }

    private function createDeleteForm($slug)
    {
        return $this->createFormBuilder(array('slug' => $slug))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
