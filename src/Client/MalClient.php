<?php

namespace JikanAuth\Client;

use GuzzleHttp\Client;
use JikanAuth\Request\Anime\AnimeAddRequest;
use JikanAuth\Request\Anime\AnimeDeleteRequest;
use JikanAuth\Request\Anime\AnimeEditRequest;
use JikanAuth\Request\LoginRequest;
use JikanAuth\Request\Manga\MangaAddRequest;
use JikanAuth\Request\Manga\MangaEditRequest;
use JikanAuth\Request\Manga\MangaDeleteRequest;

class MalClient
{
    public $guzzle;

    public $session;
    public $csrfToken;


    public function __construct(Client $guzzle = null)
    {
        $this->guzzle = $guzzle ?? new Client(['cookies'=>true, 'allow_redirects' => true]);
    }

    public function login(LoginRequest $loginRequest)
    {
        $response = $this->guzzle->request('GET', $loginRequest->getPath());
        preg_match(
            "~<meta name='csrf_token' content='(.*?)'>~",
            $response->getBody(),
            $csrf
        );

        if (empty($csrf)) {
            throw new \Exception('CSRF token could not be scraped');
        }

        $this->csrfToken = $csrf[1];


        $this->session = $response->getHeaderLine('Set-Cookie');
        $loginRequest->setSession($response->getHeaderLine('Set-Cookie'));
        $loginRequest->setCsrfToken($csrf[1]);

        $loginRequest->createRequest($this);

    }

    public function addAnime(AnimeAddRequest $animeAddRequest)
    {
        $animeAddRequest->createRequest($this);
    }

    public function editAnime(AnimeEditRequest $animeUpdateRequest)
    {
        $animeUpdateRequest->createRequest($this);
    }

    public function deleteAnime(AnimeDeleteRequest $animeRemoveRequest)
    {
        $animeRemoveRequest->createRequest($this);
    }

    public function addManga(MangaAddRequest $mangaAddRequest)
    {
        $mangaAddRequest->createRequest($this);
    }

    public function editManga(MangaEditRequest $mangaUpdateRequest)
    {
        $mangaUpdateRequest->createRequest($this);
    }

    public function deleteManga(MangaDeleteRequest $mangaRemoveRequest)
    {
        $mangaRemoveRequest->createRequest($this);
    }


    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param mixed $session
     * @return MalClient
     */
    public function setSession($session)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCsrfToken()
    {
        return $this->csrfToken;
    }

    /**
     * @param mixed $csrfToken
     * @return MalClient
     */
    public function setCsrfToken($csrfToken)
    {
        $this->csrfToken = $csrfToken;
        return $this;
    }

}
