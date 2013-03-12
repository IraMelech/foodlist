<?php

namespace My\PlanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\PlanBundle\Entity\SkladnikiListy;
use My\PlanBundle\Form\SkladnikiListyType;

/**
 * SkladnikiListy controller.
 *
 * @Route("/skladnikilisty")
 */
class SkladnikiListyController extends Controller
{
    /**
     * Lists all SkladnikiListy entities.
     *
     * @Route("/", name="skladnikilisty")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyPlanBundle:SkladnikiListy')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a SkladnikiListy entity.
     *
     * @Route("/{id}/show", name="skladnikilisty_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:SkladnikiListy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkladnikiListy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new SkladnikiListy entity.
     *
     * @Route("/new", name="skladnikilisty_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SkladnikiListy();
        $form   = $this->createForm(new SkladnikiListyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new SkladnikiListy entity.
     *
     * @Route("/create", name="skladnikilisty_create")
     * @Method("POST")
     * @Template("MyPlanBundle:SkladnikiListy:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new SkladnikiListy();
        $form = $this->createForm(new SkladnikiListyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('skladnikilisty_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SkladnikiListy entity.
     *
     * @Route("/{id}/edit", name="skladnikilisty_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:SkladnikiListy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkladnikiListy entity.');
        }

        $editForm = $this->createForm(new SkladnikiListyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing SkladnikiListy entity.
     *
     * @Route("/{id}/update", name="skladnikilisty_update")
     * @Method("POST")
     * @Template("MyPlanBundle:SkladnikiListy:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:SkladnikiListy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SkladnikiListy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SkladnikiListyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('skladnikilisty_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a SkladnikiListy entity.
     *
     * @Route("/{id}/delete", name="skladnikilisty_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyPlanBundle:SkladnikiListy')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SkladnikiListy entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('skladnikilisty'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
