@extends('templates.DefaultTemplate')

@section('Title')
  Mena | Редактировать объявление
@endsection

@section('active_breadcrumb')
  <li class="active">Редактировать объявление</li>
@endsection

@section('content')
<header><h1>Редактировать объявление</h1></header>
{{-- <form role="form" id="form-submit" class="form-submit" action="thank-you.html"> --}}
{!! Form::open(array('route' => 'path_update_item', 'method' => 'post', 'files' => 'true')) !!}
  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
  {!! csrf_field() !!}

  {{-- <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
  {!! csrf_field() !!} --}}

  <div class="row">
    <div class="col-md-9 col-sm-9">
      <section id="submit-form">
        <section id="basic-information">
          <header><h2>Карточка объекта</h2></header>

          <div class="form-group">
            <label for="submit-description">Описание</label>
            <textarea class="form-control" id="tekct_obivlenia" rows="8" name="tekct_obivlenia" >{{$house->tekct_obivlenia}}</textarea>
            <input name="id" type="hidden" value="{!! $house->id !!}" />
          </div>
          <!-- /.form-group -->
        </section>
        <!-- /#basic-information -->


        {{-- 'metro' => $request['submit-metro'],
            'gorod' =>  $request['gorod'] ,
            'ulitsa' =>  $request['submit-address'],
            'type_nedvizhimosti' => $request['type_nedvizhimosti'],
            'tekct_obivlenia' => $request['submit-description'],
            'kolitchestvo_komnat' => $request['kolitchestvo_komnat'],
            'etajnost_doma' => $request['submit-etajnost_doma'] ,
            'zhilaya_ploshad' => $request['zhilaya_ploshad'] ,
            'obshaya_ploshad' => $request['obshaya_ploshad'] ,
            'ploshad_kurhni' => $request['ploshad_kurhni'] ,
            'rayon' => isset($request['rayon']) ? $request['rayon'] : $this->getDistrict($request['gorod']) , /// trouver une autre parade
            'roof' => $request['roof-size'],
            'etazh' => $request['submit-etazh'],
            'san_usel' => $request['submit-Baths'],
            // 'title' => $request['title'],
            'price' => $request['predpolozhitelnaya_tsena'] ,
            'status' => $request['submit-status'],
            'tseli_obmena' => $request['submit-tseli-obmena'],
            'mestopolozhenie_obmena' => $request['mestopolozhenie_obmena'],
            'doplata' => $request['doplata'],
            'numberclick' => 0, --}}


        <section id="basic-information">
          <div class="row">
            <div class="block clearfix">
              <div class="col-md-6 col-sm-6">
                <section id="summary">
                  <header><h2>Подробности</h2></header>
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                              <div class="form-group" title="Укажите какой тип вашего жилья">
                                  <label for="submit-property-type">Тип жилья</label>
                                  <select name="type_nedvizhimosti" id="submit-property-type">

                                  {{-- <option value="1" id="Komnata">Квартира</option>
                                      <option value="2" id="Kvartira">Комната</option>
                                      <option value="3" id="Dom">Частный дом</option>
                                      <option value="4" id="Novostroyka">Новостройки</option> --}}

                                      {{-- @if($house->type_nedvizhimosti == '1') --}}
                                        <option value="" title="Какой вид недвижимости?" style="display:none" >Тип жилья</option>
                                        <option value="1" id="Komnata">Комната</option>
                                        <option value="2" id="Kvartira">Квартира</option>
                                        <option value="3" id="Dom">Частный дом</option>
                                        <option value="4" id="Novostroyka" >Новостройки</option>
                                      {{-- @elseif($house->type_nedvizhimosti == '2')
                                        <option value="" title="Какой вид недвижимости?" style="display:none" >Тип жилья</option>
                                        <option value="1" id="Komnata">Комната</option>
                                        <option value="2" id="Kvartira" selected>Квартира</option>
                                        <option value="3" id="Dom">Частный дом</option>
                                        <option value="4" id="Novostroyka" >Новостройки</option>
                                      @elseif($house->type_nedvizhimosti == '3')
                                        <option value="" title="Какой вид недвижимости?" style="display:none" >Тип жилья</option>
                                        <option value="1" id="Komnata">Комната</option>
                                        <option value="2" id="Kvartira">Квартира</option>
                                        <option value="3" id="Dom" selected>Частный дом</option>
                                        <option value="4" id="Novostroyka" >Новостройки</option>
                                      @else
                                        <option value="" title="Какой вид недвижимости?" style="display:none" >Тип жилья</option>
                                        <option value="1" id="Komnata">Комната</option>
                                        <option value="2" id="Kvartira">Квартира</option>
                                        <option value="3" id="Dom">Частный дом</option>
                                        <option value="4" id="Novostroyka" selected>Новостройки</option>
                                      @endif --}}
                                  </select>
                              </div><!-- /.form-group -->
                          </div><!-- /.col-md-6 -->
                          <div class="col-md-6 col-sm-6">
                              <div class="form-group" required>
                                  <label for="submit-room">Количество комнат</label>
                                  <select name="kolitchestvo_komnat" id="submit-room">
                                      <option value="" title="Сколько у Вас комнат?">Кол-во комнат</option>
                                      <option value="1" id="1room">1</option>
                                      <option value="2" id="2rooms">2</option>
                                      <option value="3" id="3rooms">3</option>
                                      <option value="4" id="4rooms">4+</option>
                                      <option value="5" id="Studio">Студия</option>

                                  </select>
                              </div>
                          </div><!-- /.col-md-6 -->
                                          <div class="col-md-6 col-sm-6">
                                              <div class="form-group">
                                                  <label for="submit-roof">Высота потолков</label>
                                                  <div class="input-group">
                                                      <input type="text" class="form-control" id="roof" name="roof" value="{{$house->roof}}" title="Обязательно измерьте">
                                                      <span class="input-group-addon">м</span>
                                                  </div>
                                              </div><!-- /.form-group -->
                                          </div><!-- /.col-md-6 -->
                                          <div class="col-md-6 col-sm-6">
                                              <div class="form-group">
                                                  <label for="submit-etazh">Ваш этаж</label>
                                                  <div class="input-group">
                                                      <input type="text" class="form-control" id="etazh" name="etazh" value="{{$house->etazh}}" title="Какой у Вас этаж?" pattern="\d*">
                                                      <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                                                  </div>
                                              </div><!-- /.form-group -->
                                          </div><!-- /.col-md-6 -->
                                          <div class="col-md-6 col-sm-6">
                                              <div class="form-group">
                                                  <label for="submit-etajnost_doma">Этажность дома</label>
                                                  <div class="input-group">
                                                      <input type="text" class="form-control" id="etajnost_doma" name="etajnost_doma" value="{{$house->etajnost_doma}}" title="Сколько этажей в доме?"pattern="\d*">
                                                      <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                                                  </div>
                                              </div><!-- /.form-group -->
                                          </div><!-- /.col-md-6 -->
                                      </div><!-- /.row -->
                                      </br>
                                      <h3> Площадь: <a href="#"><i class="fa fa-question-circle tool-tip"  data-toggle="tooltip" data-placement="right" title="Возникли затруднения с измерением? Попросите помощь в чате поддержки прямо сейчас!"></i></a></h3>
                                      <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="submit-area" title="Какова общая площадь квартиры?">Общая</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="submit-Beds" name="obshaya_ploshad" value="{{$house->superficie_totale}}" title="Какова общая площадь квартиры?" pattern="\d*" required>
                                                        <span class="input-group-addon">м<sup>2</sup></span>
                                                    </div>
                                                </div><!-- /.form-group -->
                                            </div><!-- /.col-md-6 -->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="submit-beds" title="Площадь жилой зоне очень важный параметр">Жилая</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="submit-Baths" name="zhilaya_ploshad" value="{{$house->superficie_living_room}}"  title="Площадь жилой зоне очень важный параметр" pattern="\d*" required>
                                                        <span class="input-group-addon">м<sup>2</sup></span>
                                                    </div>
                                                </div><!-- /.form-group -->
                                            </div><!-- /.col-md-6 -->
                                        </div><!-- /.row -->
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="submit-kitchen" title="Все хотят знать насколько большая кухня, укажите">Кухня</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="submit-area" name="ploshad_kurhni" value="{{$house->superficie_cuisine}}" title="Все хотят знать насколько большая кухня, укажите" pattern="\d*" required>
                                                        <span class="input-group-addon">м<sup>2</sup></span>
                                                    </div>
                                                </div><!-- /.form-group -->
                                            </div><!-- /.col-md-6 -->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="submit-Baths" title="Туалет/Ванная">Сан. узел</label>
                                                    <select name="san_usel" id="submit-Baths">


                                                        @if($house->san_usel == 'Совмещенный')
                                                            <option value="Совмещенный" selected>Совмещенный</option>
                                                            <option value="Раздельный">Раздельный</option>
                                                            <option value="Два и более">Два и более</option>
                                                        @elseif($house->san_usel == 'Раздельный')

                                                              <option value="Совмещенный">Совмещенный</option>
                                                              <option value="Раздельный" selected>Раздельный</option>
                                                              <option value="Два и более">Два и более</option>
                                                        @else
                                                          <option value="Совмещенный">Совмещенный</option>
                                                          <option value="Раздельный" >Раздельный</option>
                                                          <option value="Два и более" selected>Два и более</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div><!-- /.col-md-6 -->
                                        </div> <!-- /.row -->
                </section><!-- /#summary -->
              </div><!-- /.col-md-6 -->
              <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <section id="place-on-map">
                                        <header class="section-title"><h2>На карте</h2></header>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="submit-location">Местоположение</label>
                                                <select name="gorod" id="submit-location">
                                                    <option value="">Город</option>
                                                    {{-- <option value="" style="display:none">Все города</option> --}}

                                                    @if($house->gorod === 'Москва')

                                                      <option value="1" selected>Москва</option>
                                                      <option value="2">Московская область</option>
                                                      <option value="3">Новая Москва</option>

                                                    @elseif($house->gorod === 'Московская область')

                                                      <option value="1">Москва</option>
                                                      <option value="2" selected>Московская область</option>
                                                      <option value="3">Новая Москва</option>

                                                    @else

                                                      <option value="1">Москва</option>
                                                      <option value="2">Московская область</option>
                                                      <option value="3" selected>Новая Москва</option>
                                                    @endif
                                                </select>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="submit-district">Округ/район</label>
                                                <select name="rayon" id="submit-district">
                                                    <option value="">Округ</option>
                                                    <option value="" data-city="2" style="display:none">Все округа</option>
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
                                                    <option value="11" data-city="3">Все районы</option>
                                                    <option value="12" data-city="4">Новомосковский АО</option>
                                                    <option value="13" data-city="4">Троицкий АО</option>
                                                </select>
                                            </div><!-- /.form-group --> --}}
                                            <div class="form-group">
                                                <label for="metro">Ближайшее метро</label>
                                                <input type="text" class="form-control" id="metro" name="metro" value="{{$house->metro}}" placeholder="Укажите название станции метро рядом с Вами" required>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="address-map">Улица</label>
                                                <input type="text" class="form-control" id="address-map" name="ulitsa" value="{{$house->ulitsa}}" placeholder="Введите адрес в свободной форме" required>
                                            </div><!-- /.form-group -->

                                            {{-- <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <iframe src="https://static-maps.yandex.ru/1.x/?ll=37.620070,55.753630&spn=0.003,0.003& \
&size=393,320&z=13&l=map&pt=37.620070,55.753630,pmwtm1" width="100%" height="320" frameborder="0"></iframe>
                                                    </div><!-- /.form-group -->
                                                </div>
                                            </div> --}}
                                        </div><!-- /.col-md-12 -->
                                    </div>
                                </div><!-- /.block -->
          </div>
          <!-- /.row -->
        </section>
        <hr>
      </section>
    </div>
    <!-- /.col-md-9 -->
    <div class="col-md-3 col-sm-3">
      </br>
      <aside class="submit-step">
        <figure class="step-number">1</figure>
        <div class="description">
            <h4>Укажите информацию по объекту</h4>
            <p>Укажите точную информацию о вашей квартире или доме в полном соответствии с действительностью. Будьте внимательны. Все объявления проверяются модераторами вручную!
          </p>
        </div>
      </aside>
      <!-- /.submit-step -->
    </div>
    <!-- /.col-md-3 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="block clearfix">
      <div class="col-md-9 col-sm-9">
        <section id="submit-form">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <section id="wish-list">
                <header>
                  <h2>Желаемая цель обмена</h2></header>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="submit-status">Статус</label>
                      <select name="status" id="submit-status">

                        @if($house->status == 'Обмен продажа')
                            <option value="1">Обмен</option>
                            <option value="2" selected>Обмен продажа</option>
                        @else
                          <option value="1" selected>Обмен</option>
                          <option value="2">Обмен продажа</option>
                        @endif

                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col-md-6 -->
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <label for="submit-status">Цель обмена</label>
                      <select name="tseli_obmena" id="submit-status">

                        @if($house->tseli_obmena == '1')
                          <option value="1" selected>На увеличение</option>
                          <option value="2">На уменьшение</option>
                        @else
                          <option value="1" >На увеличение</option>
                          <option value="2" selected>На уменьшение</option>
                        @endif

                      </select>
                    </div>
                  </div>
                  <!-- /.col-md-6 -->
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <label for="submit-status">Местоположение</label>
                      <select name="mestopolozhenie_obmena" id="submit-status">
                        {{-- <option value="В_том_же_районе">В том же районе</option>
                        <option value="В_другом_районе">В другом районе</option> --}}

                        @if($house->mestopolozhenie_obmena == '1')
                          <option value="1" selected>В своём районе</option>
                          <option value="2">В другом районе</option>
                        @else
                          <option value="1">В своём районе</option>
                          <option value="2" selected>В другом районе</option>
                        @endif

                      </select>
                    </div>
                  </div>
                  <!-- /.col-md-6 -->
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="submit-price">Предположительная цена объекта</label><i class="fa fa-question-circle tool-tip" data-toggle="tooltip" data-placement="right" title="Мы можем помочь в определении рыночной цены объекта"></i>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                        <input type="text" class="form-control" id="submit-price" name="price"  value="{{$house->price_}}" pattern="\d*">
                      </div>
                    </div>
                    <!-- /.form-group -->
                  </div>
                </div>
                <!-- /.row -->

                <div>
                  <label for="account-agency">
                    Обмен с доплатой <i class="fa fa-question-circle tool-tip" data-toggle="tooltip" data-placement="right" title="Укажите если хотите получить денежную доплату при обмене"></i></label>
                </div>
                <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <div class="checkbox switch" id="agent-switch" data-agent-state="is-agent">
                      <label>
                        <input type="checkbox">
                      </label>
                    </div>
                  </div>
                  <div class="col-md-9 col-sm-9">
                    <section id="agency">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                          <input type="text" class="form-control" id="submit-doplata" name="doplata" value="{{$house->doplata_}}" >
                        </div>
                      </div>
                      <!-- /.form-group -->
                    </section>
                  </div>
                </div>

              </section>
              <!-- /#wish-list -->
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->

        </section>
      </div>
      <!-- /.col-md-9 -->
      <div class="col-md-3 col-sm-3">
        </br>
        <aside class="submit-step">
          <figure class="step-number">2</figure>
          <div class="description">
             <h4>Укажите какие цели обмена?</h4>
                  <p>Укажите большую или меньшую жильё вы хотите получить. Предположительную цену объекта и желаемую сумму доплаты, если Вы идёте на уменьшение. Будьте внимательны. От правильности заполнения зависит подбор автоматически обучаемого поиска!
                  </p>
              </div>
        </aside>
        <!-- /.submit-step -->
      </div>
      <!-- /.col-md-3 -->
    </div>
  </div>
  <!-- /.row -->
  <hr>

  <div class="row">
    <div class="block">
      <div class="col-md-9 col-sm-9">
        <div class="float-left">
          <div class="form-group">
            <button type="submit" class="btn btn-success large">Обнавить данные</button>
          </div>
          <!-- /.form-group -->
          {{-- <figure class="note block">Нажимая кнопку “Отправить данные” Вы подтверждаете, что уведомлены и согласны с <a href="{{url('/terms-conditions')}}">Правилами нашего сайта</a></figure> --}}
        </div>
      </div>

      <div class="col-md-3 col-sm-3">
        <aside class="submit-step">
          <figure class="step-number">4</figure>
          <div class="description">
              <h4>Проверьте информацию и нажмите "Отправить"</h4>
              <p>Проверьте введённую Вами информацию и только после этого нажмите продолжить. Вы всегда сможете отредактировать объявление в личном кабинете.
            </p>
          </div>
        </aside>
        <!-- /.submit-step -->
      </div>
      <!-- /.col-md-3 -->
    </div>
  </div>

  {!! Form::close() !!}
  <!--</form> /#form-submit -->
@endsection

@section('images')

<div class="col-md-9">

    <div class="block clearfix gallery">

     <header><h2>Фотографии</h2></header>

<br> <br>
     
     <div class="row">

         <div class="col-md-6 gallery__image"> 
                  
                        <form method= "POST" action="/photo/{{$house->thumb->id}}" class="update-form__btn" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="PATCH">

                            <input type="hidden" name="thumnail_id" value="{{$house->thumb->id}}">

                            {{-- <div>
                              <label for="file" class="btn success small">
                                <i class="cloud icon"></i>
                              </label>
                              <input type="file" id="hidden-new-file" style="display: none">
                            </div> --}}

                             <div class="btn-toolbar btn-toolbar-margin" role="toolbar" aria-label="Toolbar with button groups">
                              <div class="btn-group mr-2" role="group" aria-label="First group">
                                {{-- <button type="button" class="btn btn-secondary">1</button> --}}
                                <label for="upload" class="btn small"> 
                                        <i class="fa fa-upload">&nbsp;Загрузить</i>
                                        <input type="file" name="thumb" id="upload" style="display:none" accept="image/jpg, 
                                                      image/png, image/jpeg, image/pjpeg, image/x-png">
                                      </label>
                            
                              </div>
                              <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <button type="submit" class="btn success small ">Изменить</button>
                                {{-- <input type="submit" value="Изменить" class="btn success small form-control pull-left">  --}} 
                              </div>
                        
                            </div>


                            {{-- <div class="form-group">
                              <div class="input-group">
                                     <label for="upload form-control"> 
                                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true">dsgdfh</span>
                                        <input type="file" name="thumb" id="upload" style="display:none" accept="image/jpg, 
                                                      image/png, image/jpeg, image/pjpeg, image/x-png">
                                      </label>
                              </div>
                            </div>

                             <div class="form-group">
                              <div class="input-group">
                                   <input type="submit" value="Изменить" class="btn success small form-control pull-left">
                              </div>
                            </div> --}}

                        </form>
                        <a href="#">
                          <img src="{{'https://s3-us-west-2.amazonaws.com/mena-'.env('APP_ENV').'/'.$house->thumb->source}}" alt="" 
                          style="width:400px; height:250px;">
                        </a>
          </div> 
     </div>
      <h4>изображение обложки</h4>     

      <hr>

      <div class="row">
    <!-- 1 Изображение -->
          @foreach(array_chunk($house->images->data, 2) as $photo)
          <div class="row">
              @foreach($photo as $img)
                     <div class="col-md-6 gallery__image"> 
                        
                        <form method= "POST" action="/photo/{{$img->id}}" class="update-form__btn" >
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="PATCH">

                            <input type="hidden" name="thumnail_id" value="{{$house->thumb->id}}">
                            {{-- <button type="submit" class="btn success small"></button> --}}

                            {{-- <div class="input-group ">
                                <input id="uploadname" type="text" class="form-control">
                                <a class="input-group-btn btn btn-default go inline">Upload to DocMan</a>
                            </div> --}}

                                {{-- <div class="button-set">
        <button class="active">One</button>
        <button>Two</button>
        <button>Three</button>
        <button>Four</button>
        <button>Five</button>
    </div> --}}

                           <div class="button-set btn-toolbar-margin" role="toolbar" aria-label="Toolbar with button groups">
                              <div class="btn-group mr-2" role="group" aria-label="First group">
                                {{-- <button type="button" class="btn btn-secondary">1</button> --}}
                                <label for="upload" class="btn small"> 
                                        <i class="fa fa-upload">&nbsp;Загрузить</i>
                                        <input type="file" name="thumb" id="upload" style="display:none" accept="image/jpg, 
                                                      image/png, image/jpeg, image/pjpeg, image/x-png">
                                      </label>
                            
                              </div>
                              <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <button type="submit" class="btn success small ">Изменить</button>
                                {{-- <input type="submit" value="Изменить" class="btn success small form-control pull-left">  --}} 
                              </div>
                        
                            </div>

                             {{-- <div class="form-group">
                              <div class="input-group">
                                     <label for="upload" class="btn"> 
                                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true">dsgdfh</span>
                                        <input type="file" name="thumb" id="upload" style="display:none" accept="image/jpg, 
                                                      image/png, image/jpeg, image/pjpeg, image/x-png">
                                      </label>
                              </div>
                            </div>
                            <input type="submit" value="Изменить" class="btn success small input-group-btn inline"> --}}
                        </form>
                        <a href="#">
                          <img src="{{'https://s3-us-west-2.amazonaws.com/mena-'.env('APP_ENV').'/'.$img->source}}" alt="" 
                          style="width:400px; height:250px;">
                        </a>

                        <form method= "POST" action="/photo/{{$img->id}}">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="DELETE">
                            {{-- <button type="submit" class="btn success small"></button> --}}
                            <input type="submit" value="Удалить" class="btn success small">
                        </form>
                    </div>       
                  @endforeach
              </div>   
          @endforeach
         </div>
    </div>
</div>
    
@endsection
