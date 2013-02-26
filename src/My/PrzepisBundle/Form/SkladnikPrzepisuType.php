<?php

namespace My\PrzepisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkladnikPrzepisuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('skladnik', 'genemu_jqueryselect2_entity', array(
                'class' => 'My\PrzepisBundle\Entity\Skladnik',
                'property' => 'nazwa',
                'multiple' => true,
                'configs' => array(
                    'placeholder' => 'Seleziona almeno una sotto categoria',
            )
            )) 
            ->add('ilosc','text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'My\PrzepisBundle\Entity\SkladnikPrzepisu'
        ));
    }

    public function getName()
    {
        return 'sp';
    }
}
