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
        //$user = User::factory()->create();
        $response = $this->post('/api/auth/login', [
            'email' => 'admin@gmail.com',
            'password' => 'Admin123@',
        ]);
        $response = $this->json('get', '/api/pavillons');
        $response->assertStatus(200);
    }
    // public function test_create_pavillon() : void
    // {
    //     // $user = User::factory()->create();
    //     $response = $this->post('/api/auth/login', [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'Admin123@',
    //     ]);
    //     try {
    //         $response = $this->post('api/pavillon/create', [
    //             'libelle' => 'Pavillon C',
    //             'type_pavillon' => 'Femme',
    //             'nombres_etages' => 4,
    //             'nombres_chambres' => 250,
    //         ]);

    //         $response->assertStatus(200);
    //     } catch (\Exception $e) {
    //         \Illuminate\Support\Facades\Log::error($e);
    //         throw $e;
    //     }
    // }
    // public function test_update_pavillon(): void
    // {
    //     //$user = User::factory()->create();
    //     $response = $this->post('/api/auth/login', [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'Admin123@',
    //     ]);
    //     try{
    //         $response = $this->put('api/pavillon/update/4', [
    //             'libelle' => 'Pavillon D',
    //             'type_pavillon' => 'Mixte',
    //             'nombres_etages' => 4,
    //             'nombres_chambres' => 400,
    //         ]);
    //         $response->assertStatus(200);
    //     }catch(\Exception $e){
    //         \Illuminate\Support\Facades\Log::error($e);
    //         throw $e;
    //     }
    // }
    // public function test_delete_pavillon(): void
    // {

    //     // $user = User::factory()->create();
    //     $response = $this->post('/api/auth/login', [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'Admin123@',
    //     ]);
    //         $response = $this->delete('api/pavillon/delete/12');
    //         $response->assertStatus(200);
    // }

    // public function test_show_pavillon_by_id(): void
    // {
    //     $response = $this->post('/api/auth/login', [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'Admin123@',
    //     ]);
    //     $response = $this->get('api/pavillon/read/1');
    //     $response->assertStatus(200);
    // }
}
