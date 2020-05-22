<?php namespace Tests\Repositories;

use App\Models\Billings\BillingDetail;
use App\Repositories\Billings\BillingDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BillingDetailRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BillingDetailRepository
     */
    protected $billingDetailRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->billingDetailRepo = \App::make(BillingDetailRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_billing_detail()
    {
        $billingDetail = factory(BillingDetail::class)->make()->toArray();

        $createdBillingDetail = $this->billingDetailRepo->create($billingDetail);

        $createdBillingDetail = $createdBillingDetail->toArray();
        $this->assertArrayHasKey('id', $createdBillingDetail);
        $this->assertNotNull($createdBillingDetail['id'], 'Created BillingDetail must have id specified');
        $this->assertNotNull(BillingDetail::find($createdBillingDetail['id']), 'BillingDetail with given id must be in DB');
        $this->assertModelData($billingDetail, $createdBillingDetail);
    }

    /**
     * @test read
     */
    public function test_read_billing_detail()
    {
        $billingDetail = factory(BillingDetail::class)->create();

        $dbBillingDetail = $this->billingDetailRepo->find($billingDetail->id);

        $dbBillingDetail = $dbBillingDetail->toArray();
        $this->assertModelData($billingDetail->toArray(), $dbBillingDetail);
    }

    /**
     * @test update
     */
    public function test_update_billing_detail()
    {
        $billingDetail = factory(BillingDetail::class)->create();
        $fakeBillingDetail = factory(BillingDetail::class)->make()->toArray();

        $updatedBillingDetail = $this->billingDetailRepo->update($fakeBillingDetail, $billingDetail->id);

        $this->assertModelData($fakeBillingDetail, $updatedBillingDetail->toArray());
        $dbBillingDetail = $this->billingDetailRepo->find($billingDetail->id);
        $this->assertModelData($fakeBillingDetail, $dbBillingDetail->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_billing_detail()
    {
        $billingDetail = factory(BillingDetail::class)->create();

        $resp = $this->billingDetailRepo->delete($billingDetail->id);

        $this->assertTrue($resp);
        $this->assertNull(BillingDetail::find($billingDetail->id), 'BillingDetail should not exist in DB');
    }
}
