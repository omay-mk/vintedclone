<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class)
            ->add('description',CKEditorType::class)
            //->add('slug')
            ->add('prix',NumberType::class)
            //->add('created_at')
            //->add('updated_at')
           // ->add('image',TextType::class)
           ->add('imageFile',VichImageType::class,[
            'required'=>false,
            'label'=>'Image mise en avant',
        ])
            ->add('actif',CheckboxType::class,[
                'label'=>'Publier',
                'required'=>false
            ])
           // ->add('user')
            ->add('categorie',EntityType::class,[
                'class'=>Categorie::class,
                'label'=>'Catégories',
                'multiple'=>true,
                'expanded'=>true

            ])

            ->add('Enregistrer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
