<?php
namespace App\Form;

use App\Entity\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConvertType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
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
                'hocr' => 'hocr'
            ],
            'expanded' => false,
            'multiple' => false
        ]);

        $builder->add('ocrWord', CheckboxType::class, [
            'label'    => 'Show ocrWord bounding boxes',
            'required' => false,
        ]);

        $builder->add('ocrLine', CheckboxType::class, [
            'label'    => 'Show ocrLine bounding boxes',
            'required' => false,
        ]);

        $builder->add('ocrParagraph', CheckboxType::class, [
            'label'    => 'Show ocrParagraph bounding boxes',
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}