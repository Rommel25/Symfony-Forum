<?php

namespace App\Form;

use App\Entity\Lyceen;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Enum\TypeQuestionEnum;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Question $question */

        $question = $options['question'];

        if ($options['question']->getType() === TypeQuestionEnum::INTERVAL) {
            $builder->add('reponse',  IntegerType::class, [
                'label' => $question->getQuestion(),
                'required' => true,
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                ],
                'constraints' => [
                    new Range(min: 0, max: 5)
                ]
            ]);
        } elseif($options['question']->getType() === TypeQuestionEnum::CLOSE) {
            $builder->add('reponse', ChoiceType::class, [
                'label' => $question->getQuestion(),
                'required' => true,
                'choices' => ['Oui' => 'Oui', 'Non' => 'Non'],
                'expanded' => true
            ]);
        } else {
            $builder->add('reponse', TextType::class, [
                'label' => $question->getQuestion(),
                'required' => true
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
            'question' => null,
            'label' => false
        ]);
    }
}
