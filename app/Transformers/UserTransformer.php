<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\User;

/**
 * Class UserTransformer
 * @package namespace CodeProject\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model) {
        return [
            'id'        => (int)$model->id,
            'name'      => $model->name,
            'email'     => $model->email,
        ];
    }
}