<?php

namespace App\Repositories\Products\Config;

use App\Models\Products\Config\Category;
use App\Repositories\BaseRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories\Products\Config
 * @version May 21, 2020, 11:03 pm UTC
*/

class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category',
        'slug',
        'description'
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
        return Category::class;
    }

    /**
     * Return relations
     **/
    public function relations()
    {            
        return $this->model->with('image')->paginate(100);
    }
}
