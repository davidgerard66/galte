<?php

namespace Gites\GitesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gites\GitesBundle\Entity\Gites;
use Gites\GitesBundle\Form\GitesType;

/**
 * Gites controller.
 *
 */
class GitesAdminController extends Controller
{

    /**
     * Lists all Gites entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GitesBundle:Gites')->findAll();

        //var_dump($entities);


        return $this->render('GitesBundle:Administration:Gites\layout\index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Gites entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Gites();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gites_show', array('id' => $entity->getId())));
        }

        return $this->render('GitesBundle:Administration:Gites\layout\new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Gites entity.
     *
     * @param Gites $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Gites $entity)
    {
        $form = $this->createForm(new GitesType(), $entity, array(
            'action' => $this->generateUrl('admin_gites_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Creer'));

        return $form;
    }

    /**
     * Displays a form to create a new Gites entity.
     *
     */
    public function newAction()
    {
        $entity = new Gites();
        $form   = $this->createCreateForm($entity);

        return $this->render('GitesBundle:Administration:Gites\layout\new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Gites entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GitesBundle:Gites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gites entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GitesBundle:Administration:Gites\layout\show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gites entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GitesBundle:Gites')->find($id);
        $gedmo = $em->getRepository('\Gedmo\Loggable\Entity\LogEntry');
            $logs = $gedmo->getLogEntries($entity);

            // $gedmo->revert($entity,2)  pour restaurer une version ,e pas oublider de flushjer apres
        //var_dump($logs); die();


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gites entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GitesBundle:Administration:Gites\layout\edit.html.twig', array(
            'entity'      => $entity,
            'versions'    => $logs,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Gites entity.
    *
    * @param Gites $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Gites $entity)
    {
        $form = $this->createForm(new GitesType(), $entity, array(
            'action' => $this->generateUrl('admin_gites_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier', 'attr'=>array('class'=>'btn btn-success')));

        return $form;
    }
    /**
     * Edits an existing Gites entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GitesBundle:Gites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gites entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gites_edit', array('id' => $id)));
        }

        return $this->render('GitesBundle:Administration:Gites\layout\edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Gites entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GitesBundle:Gites')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gites entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_gites'));
    }

    /**
     * Creates a form to delete a Gites entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_gites_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}
