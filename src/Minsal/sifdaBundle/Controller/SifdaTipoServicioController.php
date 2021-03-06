<?php

namespace Minsal\sifdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Minsal\sifdaBundle\Entity\SifdaTipoServicio;
use Minsal\sifdaBundle\Form\SifdaTipoServicioType;

/**
 * SifdaTipoServicio controller.
 *
 * @Route("/sifdatiposervicio")
 */
class SifdaTipoServicioController extends Controller
{

    /**
     * Lists all SifdaTipoServicio entities.
     *
     * @Route("/", name="sifdatiposervicio")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MinsalsifdaBundle:SifdaTipoServicio')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SifdaTipoServicio entity.
     *
     * @Route("/", name="sifdatiposervicio_create")
     * @Method("POST")
     * @Template("MinsalsifdaBundle:SifdaTipoServicio:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SifdaTipoServicio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sifdatiposervicio_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a SifdaTipoServicio entity.
     *
     * @param SifdaTipoServicio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SifdaTipoServicio $entity)
    {
        $form = $this->createForm(new SifdaTipoServicioType(), $entity, array(
            'action' => $this->generateUrl('sifdatiposervicio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SifdaTipoServicio entity.
     *
     * @Route("/new", name="sifdatiposervicio_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SifdaTipoServicio();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SifdaTipoServicio entity.
     *
     * @Route("/{id}", name="sifdatiposervicio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinsalsifdaBundle:SifdaTipoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SifdaTipoServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SifdaTipoServicio entity.
     *
     * @Route("/{id}/edit", name="sifdatiposervicio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinsalsifdaBundle:SifdaTipoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SifdaTipoServicio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a SifdaTipoServicio entity.
    *
    * @param SifdaTipoServicio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SifdaTipoServicio $entity)
    {
        $form = $this->createForm(new SifdaTipoServicioType(), $entity, array(
            'action' => $this->generateUrl('sifdatiposervicio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SifdaTipoServicio entity.
     *
     * @Route("/{id}", name="sifdatiposervicio_update")
     * @Method("PUT")
     * @Template("MinsalsifdaBundle:SifdaTipoServicio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinsalsifdaBundle:SifdaTipoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SifdaTipoServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sifdatiposervicio_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SifdaTipoServicio entity.
     *
     * @Route("/{id}", name="sifdatiposervicio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MinsalsifdaBundle:SifdaTipoServicio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SifdaTipoServicio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sifdatiposervicio'));
    }

    /**
     * Creates a form to delete a SifdaTipoServicio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sifdatiposervicio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
