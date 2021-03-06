<?php

namespace CodeProject\Validators;

use \Prettus\Validator\LaravelValidator;

/**
 * Description of ClientValidator
 *
 * @author thiago
 */
class ProjectValidator extends LaravelValidator {
    protected $rules = [
        'name'          => 'required|max:255',
        'owner_id'      => 'required|integer',
        'client_id'     => 'required|integer',
        'description'   => 'required',
        'progress'      => 'required',
        'status'        => 'required',
        'due_date'      => 'required',
    ];
}