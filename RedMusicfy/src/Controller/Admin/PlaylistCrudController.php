<?php

namespace App\Controller\Admin;

use App\Entity\Playlist;
use App\Entity\Song;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PlaylistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Playlist::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            // Campo personalizado para seleccionar canciones
            CollectionField::new('songs')
                ->setFormTypeOptions([
                    'entry_type' => EntityType::class,
                    'entry_options' => [
                        'class' => Song::class,
                        'choice_label' => 'title', // Elige la propiedad de la canción que quieres mostrar
                        'multiple' => true, // Permite seleccionar varias canciones
                    ],
                ]),
        ];
    }
}
