This specification is for the undocumented MyAnimeList JSON API for managing lists - that's used by their own website.


# Index
- [Authentication](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#authentication)
  - [CSRF Token](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#csrf-token)
  - [Session/Cookie](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#sessioncookie)
- [GET](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#get)
- [POST](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#post)
  - **Anime**
    - [Add](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#anime--add)
    - [Edit](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#anime--edit)
    - [Delete](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#anime--delete)
  - **Anime**
    - [Add](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#manga--add)
    - [Edit](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#manga--edit)
    - [Delete](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#manga--delete)
- [Constants](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#constants)
  - [Status Constants](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#status-constants)
- [Contributing](https://github.com/jikan-me/jikan-auth/blob/master/SPECIFICATION.md#contributing)



# Authentication
You need 2 things to make this work.
- CSRF token
- Session/Cookie


## CSRF Token
Scrape the CSRF token from the [Login.php](http://myanimelist.net/login.php) page.

It's stored in a `<meta>` tag.```<meta name='csrf_token' content='PARSE_THIS_STRING'>```

[JikanAuth uses RegEx to do this](https://github.com/jikan-me/jikan-auth/blob/bc489993d767bb778de91844cf53a0f7eab71d27/src/Client/MalClient.php#L30)

## Session/Cookie
Pass the username/password through the login form via form POST. Then use session/cookie response to make further requests.

[JikanAuth does this by allowing Guzzle to store the cookies](https://github.com/jikan-me/jikan-auth/blob/bc489993d767bb778de91844cf53a0f7eab71d27/src/Client/MalClient.php#L24)

`POST http://myanimelist.net/login.php`

**Payload**

Headers
```content-type: application/x-www-form-urlencoded```

Form Data
```
user_name: `your username`
password: `your password`
csrf_token: `the token you scraped`
cookie: '1'
sublogin: 'Login'
submit: '1'
```

[JikanAuth implements this here](https://github.com/jikan-me/jikan-auth/blob/bc489993d767bb778de91844cf53a0f7eab71d27/src/Request/LoginRequest.php#L65)


# GET
//Todo


# POST
## Anime : Add
### Request

`POST https://myanimelist.net/ownlist/anime/add.json`

### JSON Body

| Key | Type | Remarks |
| --- | ----- | ---- |
| `anime_id` | Integer | MAL ID of the anime |
| `status` | Integer | [Anime Status Constants](https://github.com/jikan-me/jikan-auth/new/master#status-constants) |
| `score` | Integer | 0 - 10 |
| `num_watched_episodes` | Integer | <= 0 |
| `csrf_token` | String | Scraped Token | 


## Anime : Edit
### Request

`POST https://myanimelist.net/ownlist/anime/edit.json`

### JSON Body

| Key | Type | Remarks |
| --- | ----- | ---- |
| `anime_id` | Integer | MAL ID of the anime |
| `status` | Integer | [Anime Status Constants](https://github.com/jikan-me/jikan-auth/new/master#status-constants) |
| `score` | Integer | 0 - 10 |
| `num_watched_episodes` | Integer | <= 0 |
| `csrf_token` | String | Scraped Token | 

## Anime : Delete
### Request

```POST https://myanimelist.net/ownlist/anime/%s/delete```
Where `%s` is the MAL ID of the anime.

### JSON Body

| Key | Type | Remarks |
| --- | ----- | ---- |
| `csrf_token` | String | Scraped Token | 


## Manga : Add
### Request

`POST https://myanimelist.net/ownlist/manga/add.json`

### JSON Body

| Key | Type | Remarks |
| --- | ----- | ---- |
| `manga_id` | Integer | MAL ID of the manga |
| `status` | Integer | [Manga Status Constants](https://github.com/jikan-me/jikan-auth/new/master#status-constants) |
| `score` | Integer | 0 - 10 |
| `num_read_volumes` | Integer | Volumes read; integer (<= 0) |
| `num_read_chapters` | Integer | Chapters read; integer (<= 0) |
| `csrf_token` | String | Scraped Token | 

## Manga : Edit

### Request

`POST https://myanimelist.net/ownlist/manga/edit.json`

### JSON Body 

| Key | Type | Remarks |
| --- | ----- | ---- |
| `manga_id` | Integer | MAL ID of the manga |
| `status` | Integer | [Manga Status Constants](https://github.com/jikan-me/jikan-auth/new/master#status-constants) |
| `score` | Integer | 0 - 10 |
| `num_read_volumes` | Integer | Volumes read; integer (<= 0) |
| `num_read_chapters` | Integer | Chapters read; integer (<= 0) |
| `csrf_token` | String | Scraped Token | 


## Manga : Delete

### Request
```POST https://myanimelist.net/ownlist/manga/%s/delete```
Where `%s` is the MAL ID of the manga.


### JSON Body

| Key | Type | Remarks |
| --- | ----- | ---- |
| `csrf_token` | String | Scraped Token | 


# Constants
## Status Constants
| Status | Value |
| --- | ----- |
| Watching/Reading | `1` |
| Completed | `2` |
| On-Hold | `3` |
| Dropped | `4` |
| Plan to Watch/Read | `6` |


# Contributing
Contributions welcome, help make this specification better by creating a PR.
