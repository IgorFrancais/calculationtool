<?php

namespace App\Controller;

use App\Entity\CalculationToolForm;
use App\Form\Type\CalculationToolType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculationToolController extends AbstractController
{
    #[Route('/calculation/tool', name: 'app_calculation_tool')]
    public function index(): Response
    {
        return $this->render('calculation_tool/index.html.twig', [
            'controller_name' => 'CalculationToolController',
        ]);
        return $this->new();
    }

    public function new(Request $request): Response
    {
        $calculationForm = new CalculationToolForm();

        // use some PHP logic to decide if this form field is required or not

        $form = $this->createForm(CalculationToolType::class, $calculationForm, [
//            'action' => $this->generateUrl('calctoolnew'),
//            'method' => 'GET',
            'require_due_date' => true,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calculationForm = $form->getData();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('calctoolnew');
        }

        return $this->renderForm('calculation_tool/form.html.twig', [
            'form' => $form,
        ]);
    }
}
