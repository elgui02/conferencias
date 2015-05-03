<?php

namespace Umg\ConferenciaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConferenciumType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Conferencia')
            ->add('HoraInicio')
            ->add('HoraFIn')
            ->add('Conferencista_id')
            ->add('Salon_id')
            ->add('conferencistum')
            ->add('salon')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Umg\ConferenciaBundle\Entity\Conferencium'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'umg_conferenciabundle_conferencium';
    }
}
