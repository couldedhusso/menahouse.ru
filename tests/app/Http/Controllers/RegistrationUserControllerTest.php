<?php namespace Tests\App\Http\Controllers;

use  TestCase;

use \Mockery as m;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use DB;


use App\Http\Response\FractalResponse;

class RegistrationUserControllerTest extends TestCase
{

    /** @test **/
    public function he_get_trial_plan(){

        $user = factory('App\User::class', 1);
        $appart = factory('App\Obivlenie::class', 1);

        $nbr = \App\Subscription::select(DB::Raw('count(*) as nbre'))->get();

        $this->assertEquals(1, $nbr[0]->nbre);

      //  $this->seeInDatabase('obivlenie',  $appart->metro);

    }
    /** @test **/
    public function it_can_transform_a_collection()
    {
        $data = [
            ['foo' => 'bar'],
            ['fizz' => 'buzz'],
        ];

        // Transformer
        $transformer = m::mock('League\Fractal\TransformerAbstract');

        // Scope
        $scope = m::mock('League\Fractal\Scope');
        $scope
          ->shouldReceive('toArray')
          ->once()
          ->andReturn($data);

        // Serializer
        $serializer = m::mock('League\Fractal\Serializer\SerializerAbstract');
        $manager = m::mock('League\Fractal\Manager');

        $manager
          ->shouldReceive('setSerializer')
          ->with($serializer)
          ->once();

        $manager
          ->shouldReceive('createData')
          ->once()
          ->andReturn($scope);

        $subject = new FractalResponse($manager, $serializer);

        $this->assertInternalType('array', $subject->collection($data, $transformer));
    }
}
