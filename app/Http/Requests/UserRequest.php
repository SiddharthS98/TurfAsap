<?php

namespace App\Http\Requests;


class UserRequest extends AbstractFormRequest
{
    protected $accept = [
        "User"
    ];
}