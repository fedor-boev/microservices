<?php

namespace Tests\Feature\Controllers\Api\V1;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * Get users
     *
     * @group Admin
     * @return void
     */
    public function test_get_users_response_302(): void
    {
        $response = $this->get('/api/admin/users');

        $response->assertStatus(302);
    }
}
