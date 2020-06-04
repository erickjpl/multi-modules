<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Billings\Billing;

class BillingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_billing()
    {
        $billing = factory(Billing::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/billings/billings', $billing
        );

        $this->assertApiResponse($billing);
    }

    /**
     * @test
     */
    public function test_read_billing()
    {
        $billing = factory(Billing::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/billings/billings/'.$billing->id
        );

        $this->assertApiResponse($billing->toArray());
    }

    /**
     * @test
     */
    public function test_update_billing()
    {
        $billing = factory(Billing::class)->create();
        $editedBilling = factory(Billing::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/billings/billings/'.$billing->id,
            $editedBilling
        );

        $this->assertApiResponse($editedBilling);
    }

    /**
     * @test
     */
    public function test_delete_billing()
    {
        $billing = factory(Billing::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/billings/billings/'.$billing->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/billings/billings/'.$billing->id
        );

        $this->response->assertStatus(404);
    }
}
