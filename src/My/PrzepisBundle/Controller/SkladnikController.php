<?php

namespace My\PrzepisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use My\PrzepisBundle\Entity\Skladnik;
use My\PrzepisBundle\Form\SkladnikType;

/**
 * Skladnik controller.
 *
 * @Route("/skladnik")
 */
class SkladnikController extends Controller
{
    /**
     * Lists all Skladnik entities.
     *
     * @Route("/", name="skladnik")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyPrzepisBundle:Skladnik')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Skladnik entity.
     *
     * @Route("/{id}/show", name="skladnik_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:SkladnikPrzepisu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Skladnik entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Skladnik entity.
     *
     * @Route("/new", name="skladnik_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Skladnik();
        $form   = $this->createForm(new SkladnikType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Skladnik entity.
     *
     * @Route("/create", name="skladnik_create")
     * @Method("POST")
     * @Template("MyPrzepisBundle:Skladnik:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Skladnik();
        $form = $this->createForm(new SkladnikType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('skladnik_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Skladnik entity.
     *
     * @Route("/{id}/edit", name="skladnik_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:Skladnik')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Skladnik entity.');
        }

        $editForm = $this->createForm(new SkladnikType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Skladnik entity.
     *
     * @Route("/{id}/update", name="skladnik_update")
     * @Method("POST")
     * @Template("MyPrzepisBundle:Skladnik:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyPrzepisBundle:Skladnik')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Skladnik entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SkladnikType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('skladnik_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Skladnik entity.
     *
     * @Route("/{id}/delete", name="skladnik_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyPrzepisBundle:Skladnik')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Skladnik entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('skladnik'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
