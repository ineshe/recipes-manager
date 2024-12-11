<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\RecipeIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class RecipeIngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ingredient', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'label' => 'Zutat',
                'required' => true,
            ])
            ->add('amount', NumberType::class, [
                'label' => 'Menge',
                'required' => true,
            ])
            ->add('unit', TextType::class, [
                'label' => 'Menge',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecipeIngredient::class,
        ]);
    }
}