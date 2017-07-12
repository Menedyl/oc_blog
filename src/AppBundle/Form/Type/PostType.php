<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('title', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array(
                        'min' => 6,
                        'minMessage' => 'Au moins 6 caractères',
                        'max' => 255,
                        'maxMessage' => 'Maximum 255 caractères'
                    ))
                )
            ))
            ->add('content', TextareaType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array(
                        'min' => 100,
                        'minMessage' => 'Au moins 100 caractères'
                    ))
                )
            ))
            ->add('url', UrlType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Url(array(
                        'message' => "Ce champs doit contenir l'adresse d'un site valide",
                        'checkDNS' => true,
                        'dnsMessage' => "Cette adresse n'est pas valide"
                    ))
                )
            ))
            ->add('images', CollectionType::class, array(
                'by_reference' => false,
                'entry_type' => ImageType::class,
                'label' => 'Images :',
                'allow_add' => true,
                'allow_delete' => true,

                'entry_options' => array(
                    'attr' => array('class' => 'image'),
                    'label_attr' => array('hidden' => true)),
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_post';
    }

}