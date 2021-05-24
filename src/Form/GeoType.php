<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Ville;
use App\Controller\Geo;
use App\Entity\Monument;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$p = $options['data']->getPays();
        //$v = $p->getVilles();
        //$m = $v[0]->getMonuments();

        $builder
            ->add('pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => "nom",
                'placeholder' => "Sélectionner le pays"
            ])
            /*
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => "nom",
                'placeholder' => "Selectionner la VILLE",
                'required' => false,
                'mapped' => false,
                'choices' => $v
            ])

            ->add('monument', EntityType::class, [
                'class' => Monument::class,
                'choice_label' => "nom",
                'placeholder' => "Selectionner le MONUMENT",
                'required' => false,
                'mapped' => false,
                'choices' => $m
            ])
            */
        ;

        $builder->get('pays')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                $form = $event->getForm();
                $pays = $form->getData();
                $ville = $pays->getVilles()[0];
                if ($pays !== null) {
                    $this->addVilleField($form->getParent(), $pays);
                }
                if ($ville !==null) {
                    $this->addMonumentField($form->getParent(), $ville);
                }
            }
        );
      
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function(FormEvent $event) {
                $pays = $event->getData()->getPays();
                $ville = $event->getData()->getVille();
                $this->addVilleField($event->getForm(), $pays);
                if ($ville !== null) {
                    $this->addMonumentField($event->getForm(), $ville);    
                }
            
            }
        );
          
    }

    private function addVilleField(Form $form, Pays $pays) {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'ville',
            EntityType::class,
            null,
            [
                'class' => Ville::class,
                'choice_label' => "nom",
                'placeholder' => "Sélectionner la ville",
                'mapped' => false,
                'required' => false,
                'choices' => $pays->getVilles(),
                'auto_initialize' => false
            ]
        );
        
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                $form = $event->getForm();
                if ($form->getData() !== null) {
                    $this->addMonumentField($form->getParent(), $form->getData());
                }
            }
        );

        $form->add($builder->getForm());
    }

    private function addMonumentField(Form $form, Ville $ville) {
        $form->add('monument', EntityType::class, [
            'class' => Monument::class,
            'label' => "Monument",
            'choice_label' => "nom",
            'placeholder' => "Sélectionner un monument",
            'mapped' => 'false',
            'required' => 'false',
            'choices' => $ville->getMonuments()
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            "data_class" => Geo::class,
        ]);
    }
}
