<?php

namespace JikanAuth\Request;

use JikanAuth\Client\MalClient;

/**
 * Class LoginRequest
 * @package JikanAuth\Request
 */
class LoginRequest implements RequestInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $csrfToken;

    /**
     * @var string
     */
    private $session;

    /**
     * LoginRequest constructor.
     * @param $username
     * @param $password
     * @param null $csrfToken
     */
    public function __construct($username, $password, $csrfToken = null)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setCsrfToken($csrfToken);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return 'https://myanimelist.net/login.php';
    }

    /**
     * @param MalClient $client
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createRequest(MalClient $client)
    {

        $response = $client->guzzle->request(
            'POST',
            $this->getPath(),
            [
                'form_params' => [
                    'user_name' => $this->getUsername(),
                    'password' => $this->getPassword(),
                    'csrf_token' => $client->getCsrfToken(),
                    'cookie' => '1',
                    'sublogin' => 'Login',
                    'submit' => '1'
                ],
                'headers' => [
                    'content-type' => 'application/x-www-form-urlencoded',
                    'user-agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',
                ],
            ]
        );
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return LoginRequest
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return LoginRequest
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getCsrfToken()
    {
        return $this->csrfToken;
    }

    /**
     * @param string $csrfToken
     * @return LoginRequest
     */
    public function setCsrfToken($csrfToken)
    {
        $this->csrfToken = $csrfToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param string $session
     * @return LoginRequest
     */
    public function setSession($session)
    {
        $this->session = $session;
        return $this;
    }



}