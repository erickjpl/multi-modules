<?php namespace Tests\Repositories;

use App\Models\Billings\Billing;
use App\Repositories\Billings\BillingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BillingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BillingRepository
     */
    protected $billingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->billingRepo = \App::make(BillingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_billing()
    {
        $billing = factory(Billing::class)->make()->toArray();

        $createdBilling = $this->billingRepo->create($billing);

        $createdBilling = $createdBilling->toArray();
        $this->assertArrayHasKey('id', $createdBilling);
        $this->assertNotNull($createdBilling['id'], 'Created Billing must have id specified');
        $this->assertNotNull(Billing::find($createdBilling['id']), 'Billing with given id must be in DB');
        $this->assertModelData($billing, $createdBilling);
    }

    /**
     * @test read
     */
    public function test_read_billing()
    {
        $billing = factory(Billing::class)->create();

        $dbBilling = $this->billingRepo->find($billing->id);

        $dbBilling = $dbBilling->toArray();
        $this->assertModelData($billing->toArray(), $dbBilling);
    }

    /**
     * @test update
     */
    public function test_update_billing()
    {
        $billing = factory(Billing::class)->create();
        $fakeBilling = factory(Billing::class)->make()->toArray();

        $updatedBilling = $this->billingRepo->update($fakeBilling, $billing->id);

        $this->assertModelData($fakeBilling, $updatedBilling->toArray());
        $dbBilling = $this->billingRepo->find($billing->id);
        $this->assertModelData($fakeBilling, $dbBilling->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_billing()
    {
        $billing = factory(Billing::class)->create();

        $resp = $this->billingRepo->delete($billing->id);

        $this->assertTrue($resp);
        $this->assertNull(Billing::find($billing->id), 'Billing should not exist in DB');
    }
}
