<?php

namespace My\PlanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkladnikiListyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lista')
            ->add('przepisy')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'My\PlanBundle\Entity\SkladnikiListy'
        ));
    }

    public function getName()
    {
        return 'my_planbundle_skladnikilistytype';
    }
}
