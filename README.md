![JikanAuth](https://i.imgur.com/g4LT425.png)

# JikanAuth - Unofficial MyAnimeList.net PHP AUTH API
[![stable](https://img.shields.io/packagist/v/jikan-me/jikan-auth.svg?style=flat)](https://packagist.org/packages/jikan-me/jikan-auth) [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/jikan-me/jikan-auth.svg)](http://isitmaintained.com/project/jikan-me/jikan "Average time to resolve an issue") [![Percentage of issues still open](http://isitmaintained.com/badge/open/jikan-me/jikan.svg)](http://isitmaintained.com/project/jikan-me/jikan "Percentage of issues still open") [![stable](https://img.shields.io/badge/PHP-^%207.1-blue.svg?style=flat)]() [![Discord Server](https://img.shields.io/discord/460491088004907029.svg?style=flat&logo=discord)](https://discord.gg/4tvCr36)


JikanAuth is a PHP API for [MyAnimeList.net](https://myanimelist.net). It allows you to login and manage your anime and manga lists. It satisfies MyAnimeList's lack of API.

This library is a sister project initiative of the [Jikan API](https://github.com/jikan-me/jikan) - which covers MyAnimeList entirely for GET/read requests only. 


**This library is not production ready and may be updated frequently, use at your own risk**


### Issues
JikanAuth will **not** be a part of the [Jikan REST API](https://jikan.docs.apiary.io).

Right now it's more or less a proof of concept due to limitations from MyAnimeList.


#### Reasons
- MyAnimeList will block the IP after multiple failed login attempts.
- Having a plethora amount of logins through a singular IP will raise suspicion. As you probably know, MyAnimeList has banned a huge number of proxies/VPN IPs.


#### Possible Solutions

- Use as a private API for your app
- Use a pool of proxies that work by injecting your own Guzzle Client
- Request MyAnimeList to whitelist your IP 🤔 
- Use the PoC to come up with a client-side solution


### How it works
A short preface; I'm not the first one to come up with this. I've only implemented the idea. There's quite a number of 3rd party apps that have been using this method to manage user lists since MyAnimeList's API went down.

JikanAuth uses MyAnimeList's login for to authenticate the user and uses the session data to perform further requests such as updating the user's list.

The user's list can be updated through MyAnimeList's undocumented internal API which is used via XHR on their website.


### Does this mean Jikan can do XYZ too?
Yes, you can read messages, send messages, send friend requests, read notifcations, etc. 

But I see no point in implementing these features because I currently don't see this being practical on a larger scale as a PHP library due to the **Reasons** I mentioned above.


## Getting Started
1. `composer require jikan-me/jikan-auth`
2. [Documentation](https://github.com/jikan-me/jikan-auth/wiki/Documentation)

#### Dependencies
- Guzzle
- PHP 7.1+


## Features
- Login with Username/Password
- Manage Anime/Manga lists
    - Add
    - Edit
    - Delete
- Dependency Injection
    
## Todo
- Reuse session by storing it
- Add possible Exceptions
- Add possible responses (you don't get any response currently, it simply works)
       
    
## DISCLAIMER
- JikanAuth is not affiliated with MyAnimeList.net 
- You are responsible for the usage of this API. Please be respectful towards MyAnimeList's [Terms Of Service](https://myanimelist.net/about/terms_of_use)