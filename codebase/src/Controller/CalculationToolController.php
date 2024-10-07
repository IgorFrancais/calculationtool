<?php

namespace App\Controller;

use App\Entity\CalculationToolForm;
use App\Form\Type\CalculationToolType;
use App\Calculation\Utils\FeeCalculation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculationToolController extends AbstractController
{
    public function __construct(
        private FeeCalculation $feeCalculation
    ) {
    }

    public function calculation(Request $request): Response
    {
        $calculationToolForm = new CalculationToolForm();
        $form = $this->createForm(CalculationToolType::class, $calculationToolForm);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calculationToolForm = $form->getData();

            $vehiclePrice = $calculationToolForm->getVehiclePrice();
            $vehicleType = $calculationToolForm->getVehicleType();

            $feeBasic = $this->feeCalculation->calculateFeeBasic($vehiclePrice, $vehicleType);
            $feeSpecial = $this->feeCalculation->calculateFeeSpecial($vehiclePrice, $vehicleType);
            $feeAssociation = $this->feeCalculation->calculateFeeAssociation($vehiclePrice);
            $feeStorage = $this->feeCalculation->getFeeStorage();

            $totalPrice = $this->feeCalculation->calculateTotalPrice(
                $vehiclePrice,
                $feeBasic,
                $feeSpecial,
                $feeAssociation,
                $feeStorage
            );

            $calculationToolForm->setFeeBasic($feeBasic);
            $calculationToolForm->setFeeSpecial($feeSpecial);
            $calculationToolForm->setFeeAssociation($feeAssociation);
            $calculationToolForm->setFeeStorage($feeStorage);
            $calculationToolForm->setTotal($totalPrice);

            $formCalculated = $this->createForm(CalculationToolType::class, $calculationToolForm);

            return $this->renderForm('calculation_tool/form.html.twig', [
                'form' => $formCalculated,
            ]);
        }

        return $this->renderForm('calculation_tool/form.html.twig', [
            'form' => $form,
        ]);
    }
}
