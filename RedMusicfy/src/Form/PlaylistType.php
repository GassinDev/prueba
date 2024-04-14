<?php

namespace App\Form;

use App\Entity\Playlist;
use App\Entity\Song;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add form fields for playlist name, associated user, and songs
        $builder
            ->add('name') // Field for the name of the playlist
            ->add('user', EntityType::class, [ // Field for the associated user
                'class' => User::class, // User entity class
                'choice_label' => 'id', // Display the user's ID as the choice label
            ])
            ->add('songs', EntityType::class, [ // Field for the associated songs
                'class' => Song::class, // Song entity class
                'choice_label' => 'title', // Display the song title as the choice label
                'multiple' => true, // Allow selecting multiple songs
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Configure the form options
        $resolver->setDefaults([
            'data_class' => Playlist::class, // Data class for the form (Playlist entity)
        ]);
    }
}
