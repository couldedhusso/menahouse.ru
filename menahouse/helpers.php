<?php

use Carbon\Carbon;
use App\User;
use App\City;

function Notifications($title = null, $message = null){

    $flash = app('App\Http\Flash');

    if (func_num_args() == 0){
        return $flash;
    }
 
    return $flash->message($title, $message);
    
}

function listCities(){

    return  City::get();
}

function exprireAt($month = 1){

    $today = time() + 30 * 24 * 60 * 60;
    return $today*$month;
}

function getAppartInfos($id){

        $dispatcher = app('Dingo\Api\Dispatcher');
        $url = 'api/appart?id='.$id;

        $response = $dispatcher->raw()->get($url);
        $house = json_decode($response->content());
        $house = $house->data;

        return $house;
}

function isProprio(User $user){
    $policies = $flash = app('Menahouse\Repositories\PolicyRepository');
    return $policies->isOwner($user);
}

function link_to_model($body, $path,  $type){
    $csrf = csrf_field();
    if (is_object($path)) {

        $action = $path->getTable();
        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])){
            $action .= '/'.$path->getKey();
        }
        
    } else{
        $action = $path;
    }

    return <<<EOT
    
         <form method= "POST" action="{$action}">
            $csrf

            <input type="hidden" name="_method" value="{$type}">
            <button type="submit" class="btn success small">{$body}</button>

        </form>
EOT;
}

function sidebar(){

    $cacheKey = 'sidebar-filtre';
    $minutes = Carbon::now()->addminutes(60);

   // return Cache::remember($cacheKey, $minutes, function(){
         return <<<EOT

    
                <div class="form-group">
                    <select name="status">
                        <option value="1" selected="1">Обмен</option>
                        <option value="2">Обмен + продажа</option>
                    </select>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <select name="gorod">
                        <option value="">Город</option>
                        <option value="1">Все города</option>
                        <option value="2">Москва</option>
                        <option value="3">Московская область</option>
                        <option value="4">Новая Москва</option>
                    </select>
                </div><!-- /.form-group -->
                
                <div class="form-group">
                <select name="rayon">
                    <option value="">Округ</option>
                    <option value="" data-city="2">Все округа</option>
                    <option value="1" data-city="2">Центральный</option>
                    <option value="2" data-city="2">Северный</option>
                    <option value="3" data-city="2">Северо-Восточный</option>
                    <option value="4" data-city="2">Восточный</option>
                    <option value="5" data-city="2">Юго-Восточный</option>
                    <option value="6" data-city="2">Южный</option>
                    <option value="7" data-city="2">Юго-Западный</option>
                    <option value="8" data-city="2">Западный</option>
                    <option value="9" data-city="2">Северо-Западный</option>
                    <option value="10" data-city="2">Зеленоградский</option>

                    <option value="" data-city="3 4">Все районы</option>
                    <option value="12" data-city="4">Троицкий</option>
                </select>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <select name="type_nedvizhimosti">
                        <option value="">Тип жилья</option>
                        <option value="1">Квартира</option>
                        <option value="2">Комната</option>
                        <option value="3">Частный дом</option>
                        <option value="4">Новостройки</option>
                    </select>
                </div><!-- /.form-group -->
                
                <div class="form-group">
                            <select name="kolitchestvo_komnat">
                                <option value="">Кол-во комнат</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4+</option>
                                <option value="5">Студия</option>
                            </select>
                    </div><!-- /.form-group -->
                <div>

                <div class="slider" style="margin-top: 8px; border: 1px solid #d2d2d2">
                    <span style="font-weight:bold; margin-left: 8px;" >Площадь</span>
                    <div range-slider min="1" attach-handle-values="true" max="200" model-min="range.min" model-max="range.max"></div>
                    <div style="margin:1em; display:table;">
                        <div class="slider-control">
                            <span>От:</span>
                            <input style="height:25px" type="number" class="" name="rangeMin" ng-model="range.min">
                            <label>м2</label>
                        </div>
                        <div class="slider-control">
                            <span>До:</span>
                            <input type="number" class="" name="rangeMax" ng-model="range.max">
                            <label>м2</label>
                        </div>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="btn-group bootstrap-select">
                        <button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="Площадь" aria-expanded="true">
                            <span class="filter-option pull-left">Площадь</span>&nbsp;<span class="caret"></span>
                        </button>

                    </div>
                </div>-->
                <!--<div class="form-group">
                    <select name="area">
                        <option value="">Площадь</option>
                        <option value="1">30-70 +</option>
                        <option value="2">70-90 +</option>
                        <option value="3">90-110 +</option>
                        <option value="4">110 +</option>
                    </select>
                </div>--><!-- /.form-group -->
            </div>
                <hr>
                        <p>Критерии обмена</P>
                <div class="form-group">
                    <select name="tseli_obmena">
                        <option value="">Обмен на</option>
                        <option value="1">На увеличение</option>
                        <option value="2">На уменьшение</option>
                    </select>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <select name="mestopolozhenie_obmena">
                        <option value="">Район обмена</option>
                        <option value="1">В другом районе</option>
                        <option value="2">В своём районе</option>
                    </select>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <button type="submit"  class="btn btn-default">Искать</button>
                </div><!-- /.form-group -->
EOT;

}

