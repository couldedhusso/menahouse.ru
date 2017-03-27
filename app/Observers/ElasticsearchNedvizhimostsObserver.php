<?php

namespace App\Observers;

use App\Nedvizhimosts ;
use Elasticsearch\Client;

/**
 *
 */
class ElasticsearchNedvizhimostsObserver
{

  public function __construct(Client $elasticsearch )
  {
    $this->elasticsearch = $elasticsearch ;
  }

  public function create(Nedvizhimosts $nedvizhimosts){
      $this->elasticsearch->index([
            'index' => 'App',
            'type' => 'nedvizhimosts',
            'id' => $nedvizhimosts->id,
            'body' => $nedvizhimosts->toArray()
        ]);
  }


  public function update(Nedvizhimosts $nedvizhimosts){
      $this->elasticsearch->index([
            'index' => 'App',
            'type' => 'nedvizhimosts',
            'id' => $nedvizhimosts->id,
            'body' => $nedvizhimosts->toArray()
        ]);
  }

  public function deleted(Nedvizhimosts $nedvizhimosts){
      $this->elasticsearch->delete([
            'index' => 'App',
            'type' => 'nedvizhimosts',
            'id' => $nedvizhimosts->id
        ]);
  }
}
