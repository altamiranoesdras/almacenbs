<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserDespachaUser;

class UserDespachaUserApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_despacha_user()
    {
        $userDespachaUser = UserDespachaUser::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_despacha_users', $userDespachaUser
        );

        $this->assertApiResponse($userDespachaUser);
    }

    /**
     * @test
     */
    public function test_read_user_despacha_user()
    {
        $userDespachaUser = UserDespachaUser::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user_despacha_users/'.$userDespachaUser->id
        );

        $this->assertApiResponse($userDespachaUser->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_despacha_user()
    {
        $userDespachaUser = UserDespachaUser::factory()->create();
        $editedUserDespachaUser = UserDespachaUser::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_despacha_users/'.$userDespachaUser->id,
            $editedUserDespachaUser
        );

        $this->assertApiResponse($editedUserDespachaUser);
    }

    /**
     * @test
     */
    public function test_delete_user_despacha_user()
    {
        $userDespachaUser = UserDespachaUser::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_despacha_users/'.$userDespachaUser->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_despacha_users/'.$userDespachaUser->id
        );

        $this->response->assertStatus(404);
    }
}
