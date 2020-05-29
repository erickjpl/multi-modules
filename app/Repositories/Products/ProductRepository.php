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
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allProducts($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);
        
        $query->withCount(['billingDetails as most_selled'])
        ->with(['images', 'inventories' => function ($query) {
            $query->selectRaw('product_id,SUM(quantity) as quantity,price,promotion,discount')
                ->whereIn('status', ['in shop', 'available'])
                ->groupBy('product_id')
                ->orderBy('created_at', 'asc');
        }])->get($columns);
        
        return $query->paginate(20);
    }
}
