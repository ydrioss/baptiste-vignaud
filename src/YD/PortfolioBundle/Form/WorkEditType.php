<?php

namespace YD\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WorkEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image',        ImageType::class, array('required' => false))
            ->add('save',         SubmitType::class)
        ;
    }

    public function getParent()
    {
      return WorkType::class;
    }
}
