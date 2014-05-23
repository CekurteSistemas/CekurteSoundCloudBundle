<?php

namespace Cekurte\SoundCloudBundle\Service;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Cekurte\ComponentBundle\Util\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use \Soundcloud\Service as SoundCloudService;

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
        $this->setContainer($container);

        $this->setClient(new SoundCloudService($clientId, $clientSecret));
    }

    /**
     * Get a client
     *
     * @return SoundCloudService
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * Set a client
     *
     * @param SoundCloudService $client
     */
    protected function setClient(SoundCloudService $client)
    {
        $this->client = $client;

        return $this;
    }

    public function uploadTrack($title, $file)
    {
        $track = array(
            'track[title]'      => $title,
            'track[tags]'       => 'exemplo teste',
            'track[asset_data]' => '@' . $file
        );

        try {

            $response = $this->getClient()->getAuthorizeUrl(array('scope'=>'non-expiring'));

            // $response = $this->getClient()->post('tracks', $track);

            echo '<a href="' . $response . '">Teste</a>';

        } catch (\Soundcloud\Exception\InvalidHttpResponseCodeException $e) {
            var_dump($e);
        }

        exit;
    }
}
