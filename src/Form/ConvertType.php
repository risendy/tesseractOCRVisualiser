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

        $builder->add('boundingBoxColorWord', ChoiceType::class, [
            'choices'  => [
                'black' => 'rgb(0,0,0)',
                'red' => 'rgb(255,0,0)',
                'green' => 'rgb(0,255,0)',
                'blue' => 'rgb(0,0,255)',
            ],
            'label' => 'Bounding box color: ',
            'label_attr' => array('id' => 'labelBoundingBoxColorWord', 'style' => 'display:none'),
            'attr' => array('style'=>'display:none;'),
            'expanded' => false,
            'multiple' => false
        ]);

        $builder->add('ocrLine', CheckboxType::class, [
            'label'    => 'Show ocrLine bounding boxes',
            'required' => false,
        ]);

        $builder->add('boundingBoxColorLine', ChoiceType::class, [
            'choices'  => [
                'black' => 'rgb(0,0,0)',
                'red' => 'rgb(255,0,0)',
                'green' => 'rgb(0,255,0)',
                'blue' => 'rgb(0,0,255)',
            ],
            'label' => 'Bounding box color: ',
            'label_attr' => array('id' => 'labelBoundingBoxColorLine', 'style' => 'display:none'),
            'attr' => array('style'=>'display:none;'),
            'expanded' => false,
            'multiple' => false
        ]);

        $builder->add('ocrParagraph', CheckboxType::class, [
            'label'    => 'Show ocrParagraph bounding boxes',
            'required' => false,
        ]);

        $builder->add('boundingBoxColorParagraph', ChoiceType::class, [
            'choices'  => [
                'black' => 'rgb(0,0,0)',
                'red' => 'rgb(255,0,0)',
                'green' => 'rgb(0,255,0)',
                'blue' => 'rgb(0,0,255)',
            ],
            'label' => 'Bounding box color: ',
            'label_attr' => array('id' => 'labelBoundingBoxColorParagraph', 'style' => 'display:none'),
            'attr' => array('style'=>'display:none;'),
            'expanded' => false,
            'multiple' => false
        ]);

        $builder->add('ocrWordsOver', CheckboxType::class, [
            'label'    => 'Display recognised phrases over text',
            'required' => false,
        ]);

        $builder->add('ocrWordsColor', ChoiceType::class, [
            'choices'  => [
                'black' => 'rgb(0,0,0)',
                'red' => 'rgb(255,0,0)',
                'green' => 'rgb(0,255,0)',
                'blue' => 'rgb(0,0,255)',
            ],
            'label' => 'Word color: ',
            'label_attr' => array('id' => 'labelWordColor', 'style' => 'display:none'),
            'attr' => array('style'=>'display:none;'),
            'expanded' => false,
            'multiple' => false
        ]);

        $builder->add('ocrWordsFontSize', ChoiceType::class, [
            'choices'  => [
                '8' => '8',
                '16' => '16',
                '24' => '24',
                '32' => '32',
                '40' => '40',
                '48' => '48',
            ],
            'label' => 'Font size: ',
            'label_attr' => array('id' => 'labelFontSize', 'style' => 'display:none'),
            'attr'=>array('style'=>'display:none;'),
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