<?php

namespace My\PlanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrzepisyListyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lista')
            ->add('przepis', 'genemu_jqueryselect2_entity', array(
                'class' => 'My\PrzepisBundle\Entity\Przepis',
                'property' => 'nazwa',
                'multiple' => false,
            )) 
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'My\PlanBundle\Entity\PrzepisyListy'
        ));
    }

    public function getName()
    {
        return 'my_planbundle_przepisylistytype';
    }
}
