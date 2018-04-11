<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Movie;
use App\Genre;
use App\Actor;

class ViewsTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testGetIndex(){
      $response = $this->get('/');

      $response->assertStatus(200)->assertViewHas(['movies'=>null]);
    }

    public function testGetMovie(){
      $response = $this->get(route('getmovie',Movie::first()->id));

      $response
      ->assertStatus(200)
      ->assertViewHas([
        'movie'=>null,
        'genres'=>null,
        'actors'=>null
      ]);
    }

    public function testGetNewMovie(){
      $response = $this->get(route('newmovie'));

      $response
        ->assertStatus(200)
        ->assertViewHas([
          'genres' => null,
          'actors' => null
        ]);
    }

    // public function testCreateMovie(){
    //
    //
    //   $response = $this->post(
    //               route('createmovie'),
    //               [
    //                 'name' => 'Ready P1',
    //                 'year' => '2018',
    //                 'actors' => [Actor::first()->id],
    //                 'genre_id' => Genre::first()->id,
    //
    //               ]);
    //
    //   $response->assertSuccessful();
    // }
}
