<?php

namespace App\Controller;

use App\Entity\CalculationToolForm;
use App\Form\Type\CalculationToolType;
use App\Calculation\Utils\FeeCalculation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CalculationToolController extends AbstractController
{
    public function __construct(
        private FeeCalculation $feeCalculation,
        private CalculationToolForm $calculationToolForm
    ) {
    }

    public function calculation(Request $request): Response
    {
        $form = $this->createForm(CalculationToolType::class, $this->calculationToolForm);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->calculationToolForm = $form->getData();

            $vehiclePrice = $this->calculationToolForm->getVehiclePrice();
            $vehicleType = $this->calculationToolForm->getVehicleType();

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

            $this->calculationToolForm->setFeeBasic($feeBasic);
            $this->calculationToolForm->setFeeSpecial($feeSpecial);
            $this->calculationToolForm->setFeeAssociation($feeAssociation);
            $this->calculationToolForm->setFeeStorage($feeStorage);
            $this->calculationToolForm->setTotal($totalPrice);

            $formCalculated = $this->createForm(CalculationToolType::class, $this->calculationToolForm);

            return $this->renderForm('calculation_tool/form.html.twig', [
                'form' => $formCalculated,
            ]);
        }

        return $this->renderForm('calculation_tool/form.html.twig', [
            'form' => $form,
        ]);
    }
}
