<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChambreApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_chambre(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/api/auth/login', [
            'email' =>'admin@gmail.com',
            'password' => 'Admin123@',
        ]);
        $response = $this->post('api/admin/chambre/create/1', [
            'libelle'=> 'A chambre 10',
            'type_chambre'=> 'Partagée',
            'nombres_lits'=> 4,
            'nombres_limites'=> 8,
        ]);
        $response->assertStatus(200);

    }

    public function test_update_chambre(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/api/auth/login', [
            'email' => 'admin@gmail.com',
            'password' => 'Admin123@',
        ]);
        $response = $this->put('api/admin/chambre/update/1', [
            'libelle'=> 'A chambre 01 ',
            'type_chambre'=> 'Partagée',
            'nombres_lits'=> 2,
            'nombres_limites'=> 4,
        ]);
        $response->assertStatus(200);

    }
    public function test_delete_chambre(): void
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'email@email.com',
            'password' => 'password',
        ]);
        $response = $this->delete('api/admin/chambre/delete/22');
        $response->assertStatus(200);
    }

    public function test_show_a_chambre_by_id(): void
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ]);
        $response = $this->get('api/chambre/read/1');
        $response->assertStatus(200);
    }
    //ADMIN
    public function test_show_a_chambre_by_id_by_admin(): void
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'email@email.com',
            'password' => 'password',
        ]);
        $response = $this->get('api/admin/chambre/read/9');
        $response->assertStatus(200);
    }
    public function test_listes_chambre(): void
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'email@email.com',
            'password' => 'password',
        ]);
        $response = $this->get('api/admin/chambres');
        $response->assertStatus(200);
    }
}
