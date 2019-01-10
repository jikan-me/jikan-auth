<?php

namespace JikanAuth\Request\Anime;

use GuzzleHttp\Client;
use JikanAuth\Client\MalClient;
use JikanAuth\Request\RequestInterface;

/**
 * Class MangaAddRequest
 * @package JikanAuth\Request
 */
class AnimeAddRequest implements RequestInterface
{

    /**
     * @var int
     */
    private $animeId;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $score;

    /**
     * @var int
     */
    private $episodesWatched = 0;

    /**
     * MangaAddRequest constructor.
     * @param $animeId
     * @param $status
     * @param int $score
     * @param int $episodesWatched
     */
    public function __construct($animeId, $status, $score = 0, $episodesWatched = 0)
    {
        $this->setAnimeId($animeId);
        $this->setStatus($status);
        $this->setScore($score);
        $this->setEpisodesWatched($episodesWatched);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return 'https://myanimelist.net/ownlist/anime/add.json';
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
                    'anime_id' => $this->getAnimeId(),
                    'status' => $this->getStatus(),
                    'score' => $this->getScore(),
                    'num_watched_episodes' => $this->getEpisodesWatched(),
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
     * @return MangaAddRequest
     */
    public function setAnimeId($animeId)
    {
        $this->animeId = $animeId;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return MangaAddRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param int $score
     * @return MangaAddRequest
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return int
     */
    public function getEpisodesWatched()
    {
        return $this->episodesWatched;
    }

    /**
     * @param int $episodesWatched
     * @return MangaAddRequest
     */
    public function setEpisodesWatched($episodesWatched)
    {
        $this->episodesWatched = $episodesWatched;
        return $this;
    }



}