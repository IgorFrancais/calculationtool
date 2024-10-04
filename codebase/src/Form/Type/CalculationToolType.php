<?php

namespace App\Form\Type;

use App\Entity\CalculationToolForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CalculationToolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vehiclePrice', NumberType::class, [
                'required' => $options['require_due_date'],
            ])->add('vehicleType', TextType::class, [
                'required' => $options['require_due_date'],
            ])->add('feeBasic', NumberType::class, [
                'required' => $options['require_due_date'],
            ])->add('feeSpecial', NumberType::class, [
                'required' => $options['require_due_date'],
            ])->add('feeAssociation', NumberType::class, [
                'required' => $options['require_due_date'],
            ])->add('feeStorage', NumberType::class, [
                'required' => $options['require_due_date'],
            ])->add('total', NumberType::class, [
                'required' => $options['require_due_date'],
            ])->add('calculate', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CalculationToolForm::class,
            'require_due_date' => false,
        ]);

        $resolver->setAllowedTypes('require_due_date', 'bool');
    }
}