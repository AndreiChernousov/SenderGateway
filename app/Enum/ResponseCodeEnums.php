<?php

namespace App\Enum;

enum ResponseCodeEnums: int
{

    // ok
    case ADDED_TO_QUEUE = 1000;
    case AUTH_OK = 1100;
    // error
    case CREDENTIALS_ERROR = 2000;
    case TOKEN_ERROR = 2010;
    case NO_RECIPIENT_ERROR = 2020;
    case URL_NOT_FOUND = 2030;
    case VALIDATION_ERROR = 2040;

    public function toObject(): object
    {
        return match ($this) {
            self::ADDED_TO_QUEUE,
            self::AUTH_OK => (object)[
                'status' => 200,
                'response_code' => $this,
                'message' => $this->name,
            ],

            self::CREDENTIALS_ERROR,
            self::TOKEN_ERROR => (object)[
                'status' => 401,
                'response_code' => $this,
                'message' => $this->name,
            ],
            self::NO_RECIPIENT_ERROR => (object)[
                'status' => 401,
                'response_code' => $this,
                'message' => 'Cant find recipient',
            ],
            self::VALIDATION_ERROR => (object)[
                'status' => 406,
                'response_code' => $this,
                'message' => $this->name,
            ],
            self::URL_NOT_FOUND => (object)[
                'status' => 404,
                'response_code' => $this,
                'message' => $this->name,
            ],
        };
    }

}
