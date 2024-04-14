<?php

namespace App\Controller\Admin;

use App\Entity\Song;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SongCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Song::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Field for the record ID, hidden on the form
            IdField::new('id')
                ->hideOnForm(),

            // Field for the title of the song
            TextField::new('title'),

            // Field for the author of the song
            TextField::new('author'),

            // Field for the cover image of the song
            ImageField::new('fotoPortada', 'Cover')
                ->setBasePath('/uploads/images') // Base path for image display
                ->setUploadDir('public/uploads/images'), // Upload directory for storing images

            // Field for the audio file of the song, hidden on the index page
            ImageField::new('fileAudio', 'Audio File')
                ->setBasePath('/uploads/music') // Base path for audio file display
                ->setUploadDir('public/uploads/music') // Upload directory for storing audio files
                ->hideOnIndex() // Hide this field on the index page
        ];
    }



    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
