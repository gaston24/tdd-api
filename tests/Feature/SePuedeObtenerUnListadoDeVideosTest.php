<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Video;
use Carbon\Carbon;

class SePuedeObtenerUnListadoDeVideosTest extends TestCase
{
    use RefreshDatabase;

    public function testSePuedeObtenerUnListadoDeVideos()
    {

        // desactivar el manejo de excepciones
        // $this->withoutExceptionHandling();

        // crear el escenario
        // crear varios videos en el sistema (db)
        $video = factory(Video::class, 2)->create();

        // llamar a la api para pedir ese listado
        $response = $this->getJson('/api/videos');

        // comprobar que el listado de videos que me devuelve la api es el mismo que cree en el sistema
        $response
            ->assertOk()
            ->assertJsonCount(2);

    }

    public function testElPayloadContieneLosVideosEnELSistema(){
            
        // desactivar el manejo de excepciones
        // $this->withoutExceptionHandling();

        // crear el escenario
        // crear varios videos en el sistema (db)
        $videos = factory(Video::class, 2)->create();

        // llamar a la api para pedir ese listado
        $response = $this->getJson('/api/videos');


        // comprobar que el listado de videos que me devuelve la api es el mismo que cree en el sistema
        // $response
        //     ->assertOk()
        //     ->assertJsonFragment($videos[0]->toArray())
        //     ->assertJsonFragment($videos[1]->toArray());

        $response
            ->assertOk()
            ->assertJson($videos->toArray());
    }


    public function testLosVideosEstanOrdenadosDeMasNuevosAMasViejos(){
                
            // desactivar el manejo de excepciones
            $this->withoutExceptionHandling();
    
            // crear el escenario
            // crear video con fecha de hoy, ayer y hace un mes
            $videoHoy = factory(Video::class)->create([
                'created_at' => Carbon::now()
            ]);

            $videoAyer = factory(Video::class)->create([
                'created_at' => Carbon::now()->subDay()
            ]);

            $videoMes = factory(Video::class)->create([
                'created_at' => Carbon::now()->subMonth()
            ]);

            // llamar a la api para pedir ese listado
            $response = $this->getJson('/api/videos');

            // comprobar que el listado de videos que me devuelve la api es el mismo que cree en el sistema
            $response
                ->assertOk()
                ->assertJsonPath('0.id', $videoHoy->id)
                ->assertJsonPath('1.id', $videoAyer->id)
                ->assertJsonPath('2.id', $videoMes->id);

            // [$video1, $video2, $video3] = $response->json();

            // $this->assertEquals($videoHoy->id, $video1['id']);
            // $this->assertEquals($videoAyer->id, $video2['id']);
            // $this->assertEquals($videoMes->id, $video3['id']);
            

    }



    
}
