<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ce champ ne peut être vide.'
                    ))
                )
            ))
            ->add('content', TextareaType::class, array(
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ce champ ne peut être vide.'
                    ))
                )
            ))
            ->add('mail', EmailType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Email(array(
                        'message' => 'Vous devez entrer une adresse mail valide.',
                        'checkMX' => true
                    ))
                )
            ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }

}