<?php

namespace App\Repositories\Billings;

use App\Models\Billings\Billing;
use App\Repositories\BaseRepository;

/**
 * Class BillingRepository
 * @package App\Repositories\Billings
 * @version May 21, 2020, 11:03 pm UTC
*/

class BillingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'way_paying',
        'withdraw_order',
        'status',
        'customer_id'
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
        return Billing::class;
    }

    /**
     * Return relations
     **/
    public function relations( $request = null )
    {
        if ( ! $request->all() ) {
            return $this->model
                ->withCount(['billingDetails as products'])
                ->with(['billingDetails'])->paginate(100);
        }
            
        return $this->model
            ->where('customer_id', $request->customer_id)
            ->withCount(['billingDetails as products'])
            ->with(['billingDetails'])->paginate(100);
    }
}
