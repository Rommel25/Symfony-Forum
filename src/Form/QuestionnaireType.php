<?php

namespace App\Form;

use App\Entity\Edition;
use App\Entity\Questionnaire;
use App\Entity\Reponse;
use App\Repository\LyceenRepository;
use App\Repository\ReponseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionnaireType extends AbstractType
{
    public function __construct(private ReponseRepository $reponseRepository, private Security $security, private LyceenRepository $lyceenRepository)
    {
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $quetionnaire = $options['questionnaire'];
//        dd($quetionnaire);
//        $questions = '';
//        foreach ($quetionnaire->getQuestion() as $question){
//            $questions .= $question->getQuestion();
//        }
//        dd($questions);

        foreach ($quetionnaire->getQuestion() as $question){

            $lyceen = $this->lyceenRepository->findOneBy(['user'=>$this->security->getUser()]);
//            dd($lyceen);
            $reponse = $this->reponseRepository->findOneBy(['lyceen'=>$lyceen, 'questions' => $question]);

            if($reponse == null){
                $reponse = (new Reponse())->setQuestions($question)->setLyceen($lyceen);
            }
            $builder
                ->add('reponse' . $question->getId(), ReponseType::class, [
                    'data' => $reponse,
                    'question' => $question
                ]);
        }


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'questionnaire' => null,
        ]);
    }
}
