<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Phpbr\Bundle\AppBundle\Entity\Cole;
use Phpbr\Bundle\AppBundle\Form\ColeType;

/**
 * Cole controller.
 *
 */
class ColeController extends Controller
{

    /**
     * Lists all Cole entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PhpbrAppBundle:Cole')->findAll();

        return $this->render('PhpbrAppBundle:Cole:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Cole entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Cole();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cole_ver', array('id' => $entity->getId())));
        }

        return $this->render('PhpbrAppBundle:Cole:novo.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Cole entity.
     *
     * @param Cole $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cole $entity)
    {
        $form = $this->createForm(new ColeType(), $entity, array(
            'action' => $this->generateUrl('cole_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cole entity.
     *
     */
    public function novoAction()
    {
        $entity = new Cole();
        $form   = $this->createCreateForm($entity);

        return $this->render('PhpbrAppBundle:Cole:novo.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cole entity.
     *
     */
    public function verAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PhpbrAppBundle:Cole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $geshi =& new \GeSHi($entity->getCodigo(), $entity->getTipo());
        $codigo = $geshi->parse_code();

        return $this->render('PhpbrAppBundle:Cole:ver.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'codigo'      => $codigo,
        ));
    }

    /**
     * Finds and displays a Cole entity RAW.
     *
     */
    public function verRawAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PhpbrAppBundle:Cole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cole entity.');
        }

        $codigo = htmlspecialchars_decode($entity->getCodigo());

        $response = new Response( 
            $this->renderView('PhpbrAppBundle:Cole:verRaw.html.twig', array(
                'codigo'      => $codigo,
            ), 200)
        );

            $response->headers->set('Content-Type', 'text/plain');
            return $response;
    }

    /**
     * Displays a form to edit an existing Cole entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PhpbrAppBundle:Cole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cole entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PhpbrAppBundle:Cole:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Cole entity.
    *
    * @param Cole $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cole $entity)
    {
        $form = $this->createForm(new ColeType(), $entity, array(
            'action' => $this->generateUrl('cole_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cole entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PhpbrAppBundle:Cole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cole_edit', array('id' => $id)));
        }

        return $this->render('PhpbrAppBundle:Cole:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cole entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PhpbrAppBundle:Cole')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cole entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cole'));
    }

    /**
     * Creates a form to delete a Cole entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cole_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
