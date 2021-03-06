<?php

namespace App\Form;

use App\Entity\Evaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextareaType::class, ['label' => 'Commentaire'])
            ->add('grade', RangeType::class,[
                  'label' => 'Note de 0 à 10',
                  'attr' => ['min' => Evaluation::MIN_GRADE,
                             'max' => Evaluation::MAX_GRADE,
                             'oninput'=>'result.value=parseInt($(\'.range\').value)'
                           ],
                  
                  ])
            // ->add('evalDate')
            // ->add('movie')
            // ->add('user')
        ;
        dump($options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
        ]);
    }
}
