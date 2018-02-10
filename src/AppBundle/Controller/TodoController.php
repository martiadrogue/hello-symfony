<?php

namespace AppBundle\Controller;

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
          return $this->render('todos/create.html.twig');
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
