<?php
namespace App\Form;

use App\Entity\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fileList', EntityType::class, [
            'class' => File::class,
            'choice_label' => function ($file) {
                return $file->getFileName();
            },
            'expanded' => false,
            'multiple' => false
        ]);

        $builder->add('ocrEngine', ChoiceType::class, [
            'choices'  => [
                'TessaractOCR' => true
            ],
        ]);

        $builder->add('formatType', ChoiceType::class, [
            'choices'  => [
                'txt' => true,
                'hocr' => false
            ],
            'expanded' => false,
            'multiple' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}