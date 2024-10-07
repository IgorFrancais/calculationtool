<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CalculationToolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vehiclePrice', NumberType::class)
            ->add('vehicleType', TextType::class)
            ->add('feeBasic', NumberType::class)
            ->add('feeSpecial', NumberType::class)
            ->add('feeAssociation', NumberType::class)
            ->add('feeStorage', NumberType::class)
            ->add('total', NumberType::class)
            ->add('calculate', SubmitType::class)
        ;
    }
}