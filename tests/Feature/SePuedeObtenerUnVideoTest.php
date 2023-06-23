<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Video;

class SePuedeObtenerUnVideoTest extends TestCase
{
    
    use RefreshDatabase;

    public function testSePuedeObtenerUnVideoPorSuId()
    {
        // crear el escenario
        // crear un video en el sistema (db)
        $video = factory(Video::class)->create();

        // llamar a la api para pedir ese video
        $response = $this->get(
            sprintf('/api/videos/%s', $video->id)
        );

        // comprobar que el video que me devuelve la api es el mismo que cree en el sistema
        $response->assertJsonFragment($video->toArray());

        
    }

}
