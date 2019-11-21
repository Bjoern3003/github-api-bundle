<?php


namespace KimaiPlugin\GithubApiBundle\Event;


use App\Form\Model\Configuration;
use App\Form\Model\SystemConfiguration as SystemConfigurationModel;
use KimaiPlugin\GithubApiBundle\Form\Type\GithubApiAuthenticationType;
use KimaiPlugin\GithubApiBundle\Form\Type\GithubApiVersionType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use \App\Event\SystemConfigurationEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SystemConfigurationGithubEvent implements EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            SystemConfigurationEvent::class => ['onSystemConfiguration', 100],
        ];
    }

    public function onSystemConfiguration(SystemConfigurationEvent $event)
    {
        if(class_exists('\Github\Client'))
        {
            $event->addConfiguration((new SystemConfigurationModel())
                ->setSection('github_api')
                ->setConfiguration([
                    (new Configuration())
                        ->setName('github_api.base_url')
                        ->setLabel('github_api.base_url')
                        ->setTranslationDomain('system-configuration')
                        ->setRequired(true)
                        ->setType(TextType::class),
                    (new Configuration())
                        ->setName('github_api.api_version')
                        ->setTranslationDomain('system-configuration')
                        ->setRequired(true)
                        ->setType(GithubApiVersionType::class),
                    (new Configuration())
                        ->setName('github_api.authentication.type')
                        ->setTranslationDomain('system-configuration')
                        ->setRequired(false)
                        ->setType(GithubApiAuthenticationType::class),
                    (new Configuration())
                        ->setName('github_api.authentication.token')
                        ->setLabel('github_api.authentication.token')
                        ->setTranslationDomain('system-configuration')
                        ->setRequired(false)
                        ->setType(TextType::class),
                    (new Configuration())
                        ->setName('github_api.authentication.client_id')
                        ->setLabel('github_api.authentication.client_id')
                        ->setTranslationDomain('system-configuration')
                        ->setRequired(false)
                        ->setType(TextType::class),
                    (new Configuration())
                        ->setName('github_api.authentication.client_secret')
                        ->setLabel('github_api.authentication.client_secret')
                        ->setTranslationDomain('system-configuration')
                        ->setRequired(false)
                        ->setType(TextType::class),
                    (new Configuration())
                        ->setName('github_api.authentication.username')
                        ->setLabel('github_api.authentication.username')
                        ->setTranslationDomain('system-configuration')
                        ->setRequired(false)
                        ->setType(TextType::class),
                    (new Configuration())
                        ->setName('github_api.authentication.password')
                        ->setLabel('github_api.authentication.password')
                        ->setTranslationDomain('system-configuration')
                        ->setRequired(false)
                        ->setType(TextType::class),
                ])
            );
        }
    }
}