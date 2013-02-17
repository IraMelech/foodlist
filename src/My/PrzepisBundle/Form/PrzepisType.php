<?php

namespace My\PrzepisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use My\PrzepisBundle\Entity\SkladnikPrzepisu;
use My\PrzepisBundle\Form\SkladnikPrzepisuType;

class PrzepisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa')
        ;
        $builder->add('sp', 'collection', array(
                    'type' => new SkladnikPrzepisuType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'label' => 'Skladniki',
                    ));
        $builder->add('krok', 'collection', array(
                    'type' => new KrokType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'label' => 'Kroki',
                    ));
        $builder->add('image', 'collection', array(
                    'type' => new ImageType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'label' => 'zjecie',
                    ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'My\PrzepisBundle\Entity\Przepis'
        ));
    }

    public function getName()
    {
        return 'przepis';
    }
}
