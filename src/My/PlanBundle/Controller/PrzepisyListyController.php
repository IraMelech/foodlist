<?php

namespace My\PlanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\PlanBundle\Entity\PrzepisyListy;
use My\PlanBundle\Form\PrzepisyListyType;

/**
 * PrzepisyListy controller.
 *
 * @Route("/przepisylisty")
 */
class PrzepisyListyController extends Controller
{
    /**
     * Lists all PrzepisyListy entities.
     *
     * @Route("/", name="przepisylisty")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyPlanBundle:PrzepisyListy')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a PrzepisyListy entity.
     *
     * @Route("/{id}/show", name="przepisylisty_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:PrzepisyListy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrzepisyListy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new PrzepisyListy entity.
     *
     * @Route("/new", name="przepisylisty_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PrzepisyListy();
        $form   = $this->createForm(new PrzepisyListyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new PrzepisyListy entity.
     *
     * @Route("/create", name="przepisylisty_create")
     * @Method("POST")
     * @Template("MyPlanBundle:PrzepisyListy:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PrzepisyListy();
        $form = $this->createForm(new PrzepisyListyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('przepisylisty_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PrzepisyListy entity.
     *
     * @Route("/{id}/edit", name="przepisylisty_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:PrzepisyListy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrzepisyListy entity.');
        }

        $editForm = $this->createForm(new PrzepisyListyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PrzepisyListy entity.
     *
     * @Route("/{id}/update", name="przepisylisty_update")
     * @Method("POST")
     * @Template("MyPlanBundle:PrzepisyListy:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPlanBundle:PrzepisyListy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrzepisyListy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PrzepisyListyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('przepisylisty_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PrzepisyListy entity.
     *
     * @Route("/{id}/delete", name="przepisylisty_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyPlanBundle:PrzepisyListy')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PrzepisyListy entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('przepisylisty'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
