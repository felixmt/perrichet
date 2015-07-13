<?php
/**
*   Gallery Type
*
*   PHP version 5.5.12
*
*   @category  PHP
*   @package   AppBundle
*   @author    Felix MOTOT <felix@motot.fr>
*   @copyright 2015 Félix Motot
*   @license   Sopra http://choosealicense.com/licenses/bsd-2-clause/
*   @link      http://louisperrichet.com
*/

// src/AppBundle/Form/Type/GalleryType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Finder\Finder;

/**
* Gallery Type
*
* @category  PHP
* @package   AppBundle
* @author    Felix MOTOT <felix@motot.fr>
* @copyright 2015 Félix Motot
* @license   Sopra http://choosealicense.com/licenses/bsd-2-clause/
* @link      http://soprasteria.com  
*/
class GalleryType extends AbstractType
{
    /**
    * BuildForm
    *
    * @param FormBuilderInterface $builder form builder
    * @param array                $options options
    *
    * @return void
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // chercher les dossiers du répertoire uploads pour faire une liste de choix dans le choix du dossier
        $finder = new Finder();
        $finder->directories()->in('uploads/');
        $directories = array();
        foreach ($finder as $file) {
            $directories[$file->getRelativePathname()] = $file->getRelativePathname();
        } 
        
        $builder->add(
            'name', 'text', array(
                'label' => 'Intitulé Menu', 'attr' => array(
                    'class' => 'form-control', 
                    'maxlength' => '15',
                    'placeholder' => 'Nom de l\'élément de menu'
                )
            )
        );
        $builder->add(
            'route', 'text', array(
                'label' => 'Chemin d\'accès', 
                'attr' => array(
                    'class' => 'form-control',
                    'pattern' => '[A-Za-z]*',
                    'placeholder' => 'Chemin'
                )
            )
        );
        // $builder->add(
            // 'folder', 'text', array(
                // 'label' => 'Dossier', 'attr' => array(
                    // 'class' => 'form-control', 
                    // 'maxlength' => '15',
                    // 'placeholder' => 'Dossier où chercher les photos'
                // )
            // )
        // );
        $builder->add(
            'folder', 'choice', array(
                'label' => 'Dossier',
                'empty_value' => 'Choisissez un dossier où chercher les photos',
                'required' => false,
                'read_only' => false, 
                'choices' => $directories,
                'attr' => array(
                    'class' => 'form-control'
                ), 'required' => true 
            )
        );
        $builder->add(
            'isHomeGallery', 'checkbox', array(
                'label' => 'Utiliser en tant que page d\'accueil', 'attr' => array(
                    'class' => 'form-control'
                ), 'required' => false
            )
        );
        $builder->add(
            'Enregistrer', 'submit', array(
                'attr' => array('class' => 'btn btn-info')
            )
        );
        $builder->add(
            'Valider', 'submit', array('attr' => array('class' => 'btn btn-success'))
        );
    }
    
    /**
    * GetName
    *
    * @return string
    */
    public function getName()
    {
        return 'gallery';
    }
    
    /**
    * SetDefaultOptions
    *
    * @param optionsResolverInterface $resolver resolver
    *
    * @return void
    */
    public function configureOptions(optionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Gallery',
            )
        );
    }
}