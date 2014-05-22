<?php

namespace Cekurte\SoundCloudBundle\Service;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Cekurte\ComponentBundle\Util\ContainerAware;

/**
 * Conecta o serviço ao SoundCloud
 */
class SoundCloud extends ContainerAware
{
    /**
     * A service client
     *
     * @var \Services_Soundcloud
     */
    protected $client;

    /**
     * Inicializa o serviço
     *
     * @param ContainerInterface $container
     * @param string             $clientId
     * @param string             $clientSecret
     */
    public function __construct(ContainerInterface $container, $clientId, $clientSecret)
    {
        $this
            ->setContainer($container)
            ->setClient(new \Services_Soundcloud($clientId, $clientSecret))
        ;
    }

    /**
     * Get a client
     *
     * @return \Services_Soundcloud
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * Set a client
     *
     * @param \Services_Soundcloud $client
     */
    protected function setClient(\Services_Soundcloud $client)
    {
        $this->client = $client;

        return $this;
    }

    public function uploadTrack()
    {
        var_dump($this->getClient());
    }
}
