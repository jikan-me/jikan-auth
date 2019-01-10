<?php

namespace JikanAuth\Request\Anime;

use GuzzleHttp\Client;
use JikanAuth\Client\MalClient;
use JikanAuth\Request\RequestInterface;


/**
 * Class MangaDeleteRequest
 * @package JikanAuth\Request\Anime
 */
class AnimeDeleteRequest implements RequestInterface
{

    /**
     * @var int
     */
    private $animeId;


    /**
     * MangaDeleteRequest constructor.
     * @param $animeId
     */
    public function __construct($animeId)
    {
        $this->setAnimeId($animeId);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return sprintf('https://myanimelist.net/ownlist/anime/%s/delete', $this->getAnimeId());
    }

    /**
     * @param Client $guzzle
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createRequest(MalClient $client)
    {

        $response = $client->guzzle->request(
            'POST',
            $this->getPath(),
            [
                'body' => json_encode([
                    'csrf_token' => $client->getCsrfToken()
                ]),
                'headers' => [
                    'dnt' => '1',
                    'origin' => 'https://myanimelist.net',
                    'user-agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',
                    'x-requested-with' => 'XMLHttpRequest'
                ]
            ]
        );
    }

    /**
     * @return int
     */
    public function getAnimeId()
    {
        return $this->animeId;
    }

    /**
     * @param int $animeId
     * @return MangaRemoveRequest
     */
    public function setAnimeId($animeId)
    {
        $this->animeId = $animeId;
        return $this;
    }



}