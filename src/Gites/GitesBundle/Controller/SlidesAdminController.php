<?php

namespace Gites\GitesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gites\GitesBundle\Entity\Slides;
use Gites\GitesBundle\Form\SlidesType;

/**
 * Slides controller.
 *
 */
class SlidesAdminController extends Controller
{

    /**
     * Lists all Slides entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GitesBundle:Slides')->findAll();

        return $this->render('GitesBundle:Administration:Slides\layout\index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Slides entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Slides();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_slides_show', array('id' => $entity->getId())));
        }

        return $this->render('GitesBundle:Administration:Slides\layout\new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Slides entity.
     *
     * @param Slides $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Slides $entity)
    {
        $form = $this->createForm(new SlidesType(), $entity, array(
            'action' => $this->generateUrl('admin_slides_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter','attr'=>array('class'=>'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Slides entity.
     *
     */
    public function newAction()
    {
        $entity = new Slides();
        $form   = $this->createCreateForm($entity);

        return $this->render('GitesBundle:Administration:Slides\layout\new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Slides entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GitesBundle:Slides')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slides entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GitesBundle:Administration:Slides\layout\show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Slides entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GitesBundle:Slides')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slides entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GitesBundle:Administration:Slides\layout\edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Slides entity.
    *
    * @param Slides $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Slides $entity)
    {
        $form = $this->createForm(new SlidesType(), $entity, array(
            'action' => $this->generateUrl('admin_slides_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier','attr'=>array('class'=>'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Slides entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GitesBundle:Slides')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slides entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_slides_edit', array('id' => $id)));
        }

        return $this->render('GitesBundle:Administration:Slides\layout\edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Slides entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GitesBundle:Slides')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Slides entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_slides'));
    }

    /**
     * Creates a form to delete a Slides entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_slides_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}
