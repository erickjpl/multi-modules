<?php

namespace App\Repositories\Profile;

use App\Models\Profile\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\Profile
 * @version May 21, 2020, 11:02 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    /**
     * Return relations
     **/
    public function relations($id)
    {
        return $this->model->with(['customers'])->find($id);
    }

}
