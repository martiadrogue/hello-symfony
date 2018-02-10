<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends Controller
{
    /**
     * @Route("/todos", name="todo_list")
     */
    public function listAction(Request $request)
    {
        $todos = $this->getDoctrine()
            ->getRepository('AppBundle:Todo')
            ->findAll();

        return $this->render('todos/index.html.twig', ['todos' => $todos]);
    }

      /**
       * @Route("/todos/create", name="todo_create")
       */
      public function createAction(Request $request)
      {
          $todo = new Todo();
          $form = $this->createFormBuilder($todo)
              ->add('name', TextType::class, [ 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px'] ])
              ->add('category', TextType::class, [ 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px'] ])
              ->add('description', TextareaType::class, [ 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px'] ])
              ->add('priority', ChoiceType::class, [ 'choices' => ['Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'], 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px'] ])
              ->add('due_date', DateTimeType::class, [ 'attr' => ['class' => 'formcontrol', 'style' => 'margin-bottom:15px'] ])
              ->getForm();

          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
              die('SUBMITED');
          }

          return $this->render('todos/create.html.twig', [
              'form' => $form->createView(),
          ]);
      }


      /**
       * @Route("/todos/edit/{id}", name="todo_edit")
       */
      public function editAction($id, Request $request)
      {
          return $this->render('todos/edit.html.twig');

      }

      /**
       * @Route("/todos/details/{id}", name="todo_details")
       */
      public function detailsAction($id, Request $request)
      {
          return $this->render('todos/details.html.twig');
      }
}
