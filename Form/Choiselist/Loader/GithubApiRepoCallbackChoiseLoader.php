<?php

namespace KimaiPlugin\GithubApiBundle\Form\Choiselist\Loader;


use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use KimaiPlugin\GithubApiBundle\Controller\GithubApiController As GithubClient;

class GithubApiRepoCallbackChoiseLoader implements ChoiceLoaderInterface
{
    protected $choices =
        [
            'Maybe' => 'm',
            'Yes' => 'y',
            'No' => 'n'
        ];

    /**
     * GithubApiRepoCallbackChoiseLoader constructor.
     * @param GithubClient $client
     */
    public function __construct(GithubClient $client)
    {
        dd($client);
    }

    public function loadChoiceList($value = null)
    {
        return new ArrayChoiceList($this->choices);
    }

    public function loadChoicesForValues(array $values, $value = null)
    {
        $result = [ ];

        foreach ($values as $val)
        {
            $key = array_search($val, $this->choices, true);

            if ($key !== false)
                $result[ ] = $key;
        }

        return $result;
    }

    public function loadValuesForChoices(array $choices, $value = null)
    {
        $result = [ ];

        foreach ($choices as $label)
        {
            if (isset($this->choices[ $label ]))
                $result[ ] = $this->choices[ $label ];
        }

        return $result;
    }
}