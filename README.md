# Laravel Goodday API 

## How to install
```
composer require lexicon/goodday
```

## Usage

### Setting Token (.env)
```
GOODDAY_API_KEY=###
```

### GET Request
```
use Lexicon\Goodday\Goodday;

$users = Goodday::get('<URL>');

```

### POST Request
```
use Lexicon\Goodday\Goodday;

$body = [
    'title' => "###,
    'fromUserId' => #,
    ....
];

Goodday::post($body, "<URL>");
```
### PUT Request

```
Goodday::post($body, "<URL>", "PUT");
```
### Reference:
 - <a target="_blank" href="https://www.goodday.work/developers/api-v2">Goodday API Document</a>
