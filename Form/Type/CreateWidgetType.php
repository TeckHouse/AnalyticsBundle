<?php

namespace TeckHouse\AnalyticsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateWidgetType extends AbstractType
{

    private $supportedWidgetTypes;

    public function __construct($supportedWidgetTypes)
    {
        $this->supportedWidgetTypes = $supportedWidgetTypes;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('label', 'text', array('label' => 'Name'))
                ->add('template', 'text', array('required' => false))
                ->add('type', 'choice', array(
                        'choices'  => array_flip($this->supportedWidgetTypes),
                        'required' => true))
                ->add('collections', 'document', array( 
                        'class' => 'TeckHouse\AnalyticsBundle\Document\Collection',
                        'multiple' => true
                        ))
                ->add('name', 'hidden')
        ;
        
        $builder->addEventListener(
            FormEvents::PRE_BIND,
            function(FormEvent $event) {
                $data = $event->getData();

                $Obj = New $data['type'];
                
                if ($data['template'] == ""){
                    $data['template'] = $Obj->getTemplate();
                    $data['name'] = preg_replace('/\s+/', '', $data['label']);
                    $event->setData($data);
                }

                unset($Obj);
            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TeckHouse\AnalyticsBundle\Document\Widget'
        ));
    }
    
    
    
    public function getName()
    {
        return 'create_widget';
    }

}

?>
