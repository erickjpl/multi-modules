<?php

namespace App\Repositories\Billings;

use App\Models\Billings\BillingDetail;
use App\Repositories\BaseRepository;

/**
 * Class BillingDetailRepository
 * @package App\Repositories\Billings
 * @version May 21, 2020, 11:03 pm UTC
*/

class BillingDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'quantity',
        'tax',
        'price',
        'discount',
        'billing_id'
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
        return BillingDetail::class;
    }
}
