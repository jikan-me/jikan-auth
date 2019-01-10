<?php

namespace JikanAuth\Request\Manga;

use GuzzleHttp\Client;
use JikanAuth\Client\MalClient;
use JikanAuth\Request\RequestInterface;

/**
 * Class MangaEditRequest
 * @package JikanAuth\Request
 */
class MangaEditRequest implements RequestInterface
{

    /**
     * @var int
     */
    private $mangaId;

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
    private $volumesRead = 0;

    /**
     * @var int
     */
    private $chaptersRead = 0;


    /**
     * MangaAddRequest constructor.
     * @param $mangaId
     * @param $status
     * @param int $score
     * @param int $volumesRead
     * @param int $chaptersRead
     */
    public function __construct($mangaId, $status, $score = 0, $volumesRead = 0, $chaptersRead = 0)
    {
        $this->setMangaId($mangaId);
        $this->setStatus($status);
        $this->setScore($score);
        $this->setVolumesRead($volumesRead);
        $this->setChaptersRead($chaptersRead);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return 'https://myanimelist.net/ownlist/manga/edit.json';
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
                    'manga_id' => $this->getMangaId(),
                    'status' => $this->getStatus(),
                    'score' => $this->getScore(),
                    'num_read_volumes' => $this->getVolumesRead(),
                    'num_read_chapters' => $this->getChaptersRead(),
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

        return $response;
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
     * @return MangaEditRequest
     */
    public function setMangaId($mangaId)
    {
        $this->mangaId = $mangaId;
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
     * @return MangaEditRequest
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
     * @return MangaEditRequest
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return int
     */
    public function getVolumesRead()
    {
        return $this->volumesRead;
    }

    /**
     * @param int $volumesRead
     * @return MangaEditRequest
     */
    public function setVolumesRead($volumesRead)
    {
        $this->volumesRead = $volumesRead;
        return $this;
    }

    /**
     * @return int
     */
    public function getChaptersRead()
    {
        return $this->chaptersRead;
    }

    /**
     * @param int $chaptersRead
     * @return MangaEditRequest
     */
    public function setChaptersRead($chaptersRead)
    {
        $this->chaptersRead = $chaptersRead;
        return $this;
    }

}