<?php

namespace App\Http\Requests;

use App\Model\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse as Response;


use Kyros\Responses\JSONResponse;

abstract class AbstractFormRequest extends FormRequest
{
    protected $accept = [];

    protected $deny = [];

    public function isAccessPermitted()
    {
        $userRole = $this->user()->role;
        return Role::whereIn("name", $this->accept)->whereNotIn("name", $this->deny)->where("id", $userRole->id)->exists();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return $this->isAccessPermitted();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [];
    }

    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            $errors =  JSONResponse::init()->failed()->error($errors)->make();
            return new Response($errors, 422);
        }
    }

}
