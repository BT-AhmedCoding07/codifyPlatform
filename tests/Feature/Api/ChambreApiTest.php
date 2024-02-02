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
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->post('api/chambre/create', [
            'libelle'=> 'chambre A1',
            'type_chambre'=> 'Partagée',
            'nombres_lits'=> 4,
            'nombres_limites'=> 8,
            'pavillons_id'=> 1,
            'etudiants_id'=> 1
        ]);
        $response->assertStatus(200);

    }

    public function test_update_chambre(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->put('api/chambre/update/{id}', [
            'libelle'=> 'chambre A1',
            'type_chambre'=> 'Partagée',
            'nombres_lits'=> 2,
            'nombres_limites'=> 4,
            'pavillons_id'=> 1,
            'etudiants_id'=> 1
        ]);
        $response->assertStatus(200);

    }
    public function test_delete_chambre(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->delete('api/chambre/delete/{id}');
        $response->assertStatus(200);
    }

    public function test_show_a_chambre_by_id(): void
    {
        $response = $this->get('api/chambre/read/{id}');
        $response->assertStatus(200);
    }
    public function test_listes_chambre(): void
    {
        $response = $this->get('api/chambres');
        $response->assertStatus(200);
    }
}
