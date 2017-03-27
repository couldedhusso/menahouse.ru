<?php namespace Tests\App\Http\Controllers;

use  TestCase;

use \Mockery as m;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


use App\Http\Response\FractalResponse;

class AdvertiseControllerTest extends TestCase
{
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
