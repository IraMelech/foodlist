<?php

namespace My\PlanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\PlanBundle\Entity\Lista;
use My\PlanBundle\Form\ListaType;

/**
 * Lista controller.
 *
 * @Route("/lista")
 */
class ListaController extends Controller
{
    /**
     * Lists all Lista entities.
     *
     * @Route("/", name="lista")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyPlanBundle:Lista')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Lista entity.
     *
     * @Route("/{id}/show", name="lista_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:Lista')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lista entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Lista entity.
     *
     * @Route("/new", name="lista_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Lista();
        $form   = $this->createForm(new ListaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Lista entity.
     *
     * @Route("/create", name="lista_create")
     * @Method("POST")
     * @Template("MyPlanBundle:Lista:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Lista();
        $form = $this->createForm(new ListaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lista_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Lista entity.
     *
     * @Route("/{id}/edit", name="lista_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:Lista')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lista entity.');
        }

        $editForm = $this->createForm(new ListaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Lista entity.
     *
     * @Route("/{id}/update", name="lista_update")
     * @Method("POST")
     * @Template("MyPlanBundle:Lista:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:Lista')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lista entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ListaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lista_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Lista entity.
     *
     * @Route("/{id}/delete", name="lista_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyPlanBundle:Lista')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lista entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('lista'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
