<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Enterprise;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnterpriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [

                'label' => 'Nom'])

            ->add('email')
            ->add('contacts', EntityType::class, [
                'class'  => Contact::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false
            ])

            ->add('type', EntityType::class, [
                'class'  => Type::class,
                    'choice_label' => 'name'])
            ->add('french', ChoiceType::class, [
                'choices' => [
                    'Non' => '0',
                    'Oui' => '1'
                ]

        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enterprise::class,
        ]);
    }
}
