<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\EnvioFiscal;

class EnvioFiscalApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_envio_fiscal()
    {
        $envioFiscal = EnvioFiscal::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/envio_fiscales', $envioFiscal
        );

        $this->assertApiResponse($envioFiscal);
    }

    /**
     * @test
     */
    public function test_read_envio_fiscal()
    {
        $envioFiscal = EnvioFiscal::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/envio_fiscales/'.$envioFiscal->id
        );

        $this->assertApiResponse($envioFiscal->toArray());
    }

    /**
     * @test
     */
    public function test_update_envio_fiscal()
    {
        $envioFiscal = EnvioFiscal::factory()->create();
        $editedEnvioFiscal = EnvioFiscal::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/envio_fiscales/'.$envioFiscal->id,
            $editedEnvioFiscal
        );

        $this->assertApiResponse($editedEnvioFiscal);
    }

    /**
     * @test
     */
    public function test_delete_envio_fiscal()
    {
        $envioFiscal = EnvioFiscal::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/envio_fiscales/'.$envioFiscal->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/envio_fiscales/'.$envioFiscal->id
        );

        $this->response->assertStatus(404);
    }
}
