<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Billings\BillingDetail;

class BillingDetailApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_billing_detail()
    {
        $billingDetail = factory(BillingDetail::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/billings/billing_details', $billingDetail
        );

        $this->assertApiResponse($billingDetail);
    }

    /**
     * @test
     */
    public function test_read_billing_detail()
    {
        $billingDetail = factory(BillingDetail::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/billings/billing_details/'.$billingDetail->id
        );

        $this->assertApiResponse($billingDetail->toArray());
    }

    /**
     * @test
     */
    public function test_update_billing_detail()
    {
        $billingDetail = factory(BillingDetail::class)->create();
        $editedBillingDetail = factory(BillingDetail::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/billings/billing_details/'.$billingDetail->id,
            $editedBillingDetail
        );

        $this->assertApiResponse($editedBillingDetail);
    }

    /**
     * @test
     */
    public function test_delete_billing_detail()
    {
        $billingDetail = factory(BillingDetail::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/billings/billing_details/'.$billingDetail->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/billings/billing_details/'.$billingDetail->id
        );

        $this->response->assertStatus(404);
    }
}
