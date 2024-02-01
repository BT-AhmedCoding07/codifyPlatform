<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Pavillon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpParser\Node\Stmt\TryCatch;

class PavillonApiTest extends TestCase
{

    public function test_liste(): void
    {
        $response = $this->json('get', '/api/pavillons');
        $response->assertStatus(200);
    }
    public function test_create_pavillon() : void
    {
        $user = User::factory()->create();
        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        try {
            $response = $this->post('api/pavillon/create', [
                'libelle' => 'Pavillon F',
                'type_pavillon' => 'Homme',
                'nombres_etages' => 4,
                'nombres_chambres' => 300,
            ]);

            $response->assertStatus(200);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);
            throw $e;
        }
    }
    public function test_update_pavillon(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        try{
            $response = $this->put('api/pavillon/update/10', [
                'libelle' => 'Pavillon F',
                'type_pavillon' => 'Mixte',
                'nombres_etages' => 3,
                'nombres_chambres' => 300,
            ]);
            $response->assertStatus(200);
        }catch(\Exception $e){
            \Illuminate\Support\Facades\Log::error($e);
            throw $e;
        }
    }
    public function test_delete_pavillon(): void
    {

        $user = User::factory()->create();
        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
            $response = $this->delete('api/pavillon/delete/2');
            $response->assertStatus(200);
    }

    public function test_show_pavillon(): void
    {
        $response = $this->get('api/pavillon/read/1');
        $response->assertStatus(200);
    }
}
