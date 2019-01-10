<?php

namespace JikanAuth\Request\Manga;

use GuzzleHttp\Client;
use JikanAuth\Client\MalClient;
use JikanAuth\Request\RequestInterface;


/**
 * Class MangaDeleteRequest
 * @package JikanAuth\Request\Anime
 */
class MangaDeleteRequest implements RequestInterface
{

    /**
     * @var int
     */
    private $mangaId;


    /**
     * MangaDeleteRequest constructor.
     * @param $mangaId
     */
    public function __construct($mangaId)
    {
        $this->setMangaId($mangaId);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return sprintf('https://myanimelist.net/ownlist/manga/%s/delete', $this->getMangaId());
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
    public function getMangaId()
    {
        return $this->mangaId;
    }

    /**
     * @param int $mangaId
     * @return MangaDeleteRequest
     */
    public function setMangaId($mangaId)
    {
        $this->mangaId = $mangaId;
        return $this;
    }


}