<?php

namespace KimaiPlugin\GithubApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GithubApiAuthenticationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => 'github_api.authentication.type',
            'choices' => [
                'None' => 'none', 'URL Token' => 'url_token', 'Client ID' => 'url_client_id', 'HTTP Password' => 'http_password', 'HTTP Token' => 'http_token'
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}