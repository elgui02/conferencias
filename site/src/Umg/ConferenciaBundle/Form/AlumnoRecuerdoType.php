<?php

namespace Umg\ConferenciaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlumnoRecuerdoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FechaHora','datetime',array(
                'date_widget' => "single_text", 
                'time_widget' => "single_text"
            ))
            ->add('alumno')
            ->add('recuerdo')
            ->add('usuario')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Umg\ConferenciaBundle\Entity\AlumnoRecuerdo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'umg_conferenciabundle_alumnorecuerdo';
    }
}
