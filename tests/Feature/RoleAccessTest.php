<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Staff;
use App\Models\Aset;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/kamars')->assertRedirect('/login');
        $this->get('/penghuni')->assertRedirect('/login');
        $this->get('/staff')->assertRedirect('/login');
        $this->get('/asets')->assertRedirect('/login');
    }

    public function test_admin_has_full_access(): void
    {
        $admin = User::where('email', 'admin@kos.com')->first();
        $this->actingAs($admin);

        $this->get('/dashboard')->assertStatus(200);
        $this->get('/kamars')->assertStatus(200);
        $this->get('/kamars/create')->assertStatus(200);
        $this->get('/penghuni')->assertStatus(200);
        $this->get('/penghuni/create')->assertStatus(200);
        $this->get('/staff')->assertStatus(200);
        $this->get('/staff/create')->assertStatus(200);
        $this->get('/asets')->assertStatus(200);
        $this->get('/asets/create')->assertStatus(200);
    }

    public function test_staff_has_restricted_access(): void
    {
        $staff = User::where('email', 'staff@kos.com')->first();
        $this->actingAs($staff);

        // Allowed: Dashboard, View Kamar, View Penghuni, Full Staff, Full Aset
        $this->get('/dashboard')->assertStatus(200);
        $this->get('/kamars')->assertStatus(200);
        $this->get('/penghuni')->assertStatus(200);
        $this->get('/staff')->assertStatus(200);
        $this->get('/staff/create')->assertStatus(200);
        $this->get('/asets')->assertStatus(200);
        $this->get('/asets/create')->assertStatus(200);

        // Blocked from Kamar and Penghuni CUD (Redirects back with error)
        $this->from('/kamars')->get('/kamars/create')
            ->assertRedirect('/kamars')
            ->assertSessionHas('error');

        $this->from('/penghuni')->get('/penghuni/create')
            ->assertRedirect('/penghuni')
            ->assertSessionHas('error');
    }

    public function test_penghuni_has_read_only_access(): void
    {
        $penghuni = User::where('email', 'penghuni@kos.com')->first();
        $this->actingAs($penghuni);

        // Allowed to view dashboards and index lists
        $this->get('/dashboard')->assertStatus(200);
        $this->get('/kamars')->assertStatus(200);

        // Opsi 2: Penghuni hanya melihat data hunian miliknya sendiri
        $response = $this->get('/penghuni');
        $response->assertStatus(200);
        $response->assertSee('Informasi Hunian');

        $this->get('/staff')->assertStatus(200);
        $this->get('/asets')->assertStatus(200);

        // Blocked from all CUD actions across all 4 modules
        $this->from('/kamars')->get('/kamars/create')
            ->assertRedirect('/kamars')
            ->assertSessionHas('error');

        $this->from('/penghuni')->get('/penghuni/create')
            ->assertRedirect('/penghuni')
            ->assertSessionHas('error');

        $this->from('/staff')->get('/staff/create')
            ->assertRedirect('/staff')
            ->assertSessionHas('error');

        $this->from('/asets')->get('/asets/create')
            ->assertRedirect('/asets')
            ->assertSessionHas('error');
    }
}
