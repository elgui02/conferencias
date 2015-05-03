<?php

namespace Umg\ConferenciaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConferenciaAlumnoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Alumno_id')
            ->add('Conferencia_id')
            ->add('alumno')
            ->add('conferencium')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Umg\ConferenciaBundle\Entity\ConferenciaAlumno'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'umg_conferenciabundle_conferenciaalumno';
    }
}
