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
     * @Route("/", name="przepis")
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
     * @Route("/{id}/show", name="przepis_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:Przepis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Przepis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

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
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('przepis_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Przepis entity.
     *
     * @Route("/{id}/edit", name="przepis_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:Przepis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Przepis entity.');
        }

        $editForm = $this->createForm(new PrzepisType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Przepis entity.
     *
     * @Route("/{id}/update", name="przepis_update")
     * @Method("POST")
     * @Template("MyPrzepisBundle:Przepis:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:Przepis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Przepis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PrzepisType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('przepis_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Przepis entity.
     *
     * @Route("/{id}/delete", name="przepis_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyPrzepisBundle:Przepis')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Przepis entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('przepis'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
