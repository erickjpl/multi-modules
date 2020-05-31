<?php

namespace App\Repositories\Products\Sales;

use App\Models\Products\Sales\Inventory;
use App\Repositories\BaseRepository;

/**
 * Class InventoryRepository
 * @package App\Repositories\Products\Sales
 * @version May 21, 2020, 11:03 pm UTC
*/

class InventoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'quantity',
        'discount',
        'price',
        'status',
        'observation',
        'product_id'
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
        return Inventory::class;
    }

    /**
     * Return relations
     **/
    public function relations()
    {
        return $this->model->with('product:id,product,slug,category_id')->paginate(100);
    }
}
