<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $userRole;
    protected $adminRole;
    protected $user;
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRole = Role::firstOrCreate(['nombre' => 'user'], ['descripcion' => 'User']);
        $this->adminRole = Role::firstOrCreate(['nombre' => 'admin'], ['descripcion' => 'Admin']);

        $this->user = User::factory()->create(['rol_id' => $this->userRole->id]);
        $this->admin = User::factory()->create(['rol_id' => $this->adminRole->id]);
    }

    public function test_user_can_view_edit_role()
    {
        $response = $this->actingAs($this->user)->get('/role/edit');
        $response->assertStatus(200);
    }

    public function test_admin_cannot_edit_role()
    {
        $response = $this->actingAs($this->admin)->get('/role/edit');
        $response->assertStatus(403);
    }

    public function test_user_can_update_role()
    {
        $response = $this->actingAs($this->user)->put('/role/update', [
            'rol_id' => $this->adminRole->id
        ]);
        $response->assertRedirect();
    }

    public function test_admin_can_manage_users()
    {
        $response = $this->actingAs($this->admin)->get('/admin/roles/users');
        $response->assertStatus(200);
    }

    public function test_admin_update_user_role()
    {
        $other = User::factory()->create(['rol_id' => $this->userRole->id]);
        $response = $this->actingAs($this->admin)->put("/admin/roles/users/{$other->id}", [
            'rol_id' => $this->adminRole->id
        ]);
        $response->assertRedirect();
    }
}
