<?php

namespace App\Repositories\Products;

use App\Models\Products\Product;
use App\Repositories\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories\Products
 * @version May 21, 2020, 11:03 pm UTC
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product',
        'slug',
        'description',
        'category_id'
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
        return Product::class;
    }

    /**
     * Return relations
     **/
    public function relations( $request = null )
    {
        if ( ! $request->all() ) 
            return $this->model->withCount(['billingDetails'])->get();
            
        return $this->model->where('category_id', $request->category_id)->withCount(['billingDetails'])->get();
    }
}
