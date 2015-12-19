<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\PagesBundle\Entity\Pages;
use Pages\PagesBundle\Form\pagesType;

/**
 * pages controller.
 *
 */
class pagesAdminController extends Controller
{

    /**
     * Lists all pages entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PagesBundle:Pages')->findAll();
        //dump($entities);
        //var_dump($entities);
        //die();

        return $this->render('PagesBundle:Administration:pages/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists all deleted pages.
     *
     */
    public function softDelAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');

        $entities = $em->getRepository('PagesBundle:Pages')->findByDeleted();
        //dump($entities);
        //var_dump($entities);
        //die();

        return $this->render('PagesBundle:Administration:pages/layout/softdel.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * restaure a deleted pages.
     *
     */
    public function restoreAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');

        $entity = $em->getRepository('PagesBundle:Pages')->find($id);

            $entity->setDeletedAt(null);
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('adminPages'));
       //dump($entity);
       // die();
    }

    /**
     * Creates a new pages entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new pages();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adminPages_show', array('id' => $entity->getId())));
        }

        return $this->render('PagesBundle:Administration:pages/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a pages entity.
     *
     * @param pages $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(pages $entity)
    {
        $form = $this->createForm(new pagesType(), $entity, array(
            'action' => $this->generateUrl('adminPages_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new pages entity.
     *
     */
    public function newAction()
    {
        $entity = new Pages();
        $form   = $this->createCreateForm($entity);

        return $this->render('PagesBundle:Administration:pages/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pages entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PagesBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PagesBundle:Administration:pages/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pages entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PagesBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pages entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PagesBundle:Administration:pages/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a pages entity.
    *
    * @param pages $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pages $entity)
    {
        $form = $this->createForm(new pagesType(), $entity, array(
            'action' => $this->generateUrl('adminPages_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing pages entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PagesBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find pages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adminPages_edit', array('id' => $id)));
        }

        return $this->render('PagesBundle:Administration:pages/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a pages entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PagesBundle:Pages')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find pages entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adminPages'));
    }

    /**
     * Creates a form to delete a pages entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminPages_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
