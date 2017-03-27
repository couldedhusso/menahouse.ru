<?php
namespace Menahouse\Contracts;

interface CitiesInterface{

    public function getCities();
    public function getDistricts($id_city);
}
