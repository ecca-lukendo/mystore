<?php

namespace Sdz\MainBundle\Form;

use Sdz\MainBundle\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
						->add('categorie', 'entity', array('class' => 'SdzMainBundle:Categorie', 'property' => 'nom', 'multiple' => false))
            ->add('nom', 'text')
            ->add('prix', 'number')
            ->add('quantite', 'integer')
						->add('description', 'textarea')
            ->add('image', 'text')
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sdz\MainBundle\Entity\Produit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sdz_mainbundle_produit';
    }
}
