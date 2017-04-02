@extends('templates.DefaultTemplate')
@section('Title')
  Mena | Add Your Property
@endsection
@section('active_breadcrumb')
  <li class="active">Добавить объявление</li>
@endsection
@section('content')
<header>
  <h1>Добавить новое объявление</h1></header>
{{--
<form role="form" id="form-submit" class="form-submit" action="thank-you.html"> --}}
{!! Form::open(array('route' => 'additem_path', 'method' => 'post', 'files' => 'true')) !!}
  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
  {!! csrf_field() !!}

  <div class="row">
    <div class="col-md-9 col-sm-9">
      <section id="submit-form">
        <section id="basic-information">
          <header><h2>Карточка объекта</h2></header>

          <div class="form-group">
            <label for="submit-description">Описание</label>
            <textarea class="form-control" id="submit-description" rows="8" name="submit-description" placeholder="Введите краткое описание объекта. Всё самое необходимое, что Вам кажется важным" required></textarea>
          </div>
          <!-- /.form-group -->
        </section>
        <!-- /#basic-information -->

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
                                      <option value="" title="Какой вид недвижимости?" style="display:none" >Тип жилья</option>
                                      <option value="1" id="Kvartira">Квартира</option>
                                      <option value="2" id="Komnata">Комната</option>
                                      <option value="3" id="Dom">Частный дом</option>
                                      <option value="4" id="Novostroyka">Новостройки</option>
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
                                                      <input type="text" class="form-control" id="submit-roof" name="roof-size" title="Обязательно измерьте "placeholder="" >
                                                      <span class="input-group-addon">м</span>
                                                  </div>
                                              </div><!-- /.form-group -->
                                          </div><!-- /.col-md-6 -->
                                          <div class="col-md-6 col-sm-6">
                                              <div class="form-group">
                                                  <label for="ssubmit-etazh">Ваш этаж</label>
                                                  <div class="input-group">
                                                      <input type="text" class="form-control" id="submit-etazh" name="submit-etazh" title="Какой у Вас этаж?" pattern="\d*">
                                                      <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                                                  </div>
                                              </div><!-- /.form-group -->
                                          </div><!-- /.col-md-6 -->
                                          <div class="col-md-6 col-sm-6">
                                              <div class="form-group">
                                                  <label for="submit-etajnost_doma">Этажность дома</label>
                                                  <div class="input-group">
                                                      <input type="text" class="form-control" id="submit-roof" name="submit-etajnost_doma" title="Сколько этажей в доме?"pattern="\d*">
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
                                                        <input type="text" class="form-control" id="submit-area" name="obshaya_ploshad" title="Какова общая площадь квартиры?" pattern="\d*" required>
                                                        <span class="input-group-addon">м<sup>2</sup></span>
                                                    </div>
                                                </div><!-- /.form-group -->
                                            </div><!-- /.col-md-6 -->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="submit-beds" title="Площадь жилой зоне очень важный параметр">Жилая</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="submit-Beds" name="zhilaya_ploshad" title="Площадь жилой зоне очень важный параметр" pattern="\d*" required>
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
                                                        <input type="text" class="form-control" id="submit-kitchen" name="ploshad_kurhni" title="Все хотят знать насколько большая кухня, укажите" pattern="\d*" required>
                                                        <span class="input-group-addon">м<sup>2</sup></span>
                                                    </div>
                                                </div><!-- /.form-group -->
                                            </div><!-- /.col-md-6 -->
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="submit-Baths" title="Туалет/Ванная">Сан. узел</label>
                                                    <select name="submit-Baths" id="submit-Baths">
                                                        <option value="Совмещенный">Совмещенный</option>
                                                        <option value="Раздельный">Раздельный</option>
                                                        <option value="Два и более">Два и более</option>
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
                                                <select name="gorod" id="submit-location" required>
                                                    {{-- <option value=""></option> --}}
                                                    <option value="" title="Какой город?" style="display:none;">Город</option>
                                                    @foreach(listCities() as $city)
                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                                    {{-- <option value="" style="display:none">Все города</option> --}}
                                                    {{-- <option value="2">Московская область</option>
                                                    <option value="3">Новая Москва</option> --}}
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
                                                    <option value="11" selected="11" data-city="3">Все районы</option>
                                                    <option value="12" data-city="4">Новомосковский АО</option>
                                                    <option value="13" data-city="4">Троицкий АО</option>
                                                </select>
                                            </div><!-- /.form-group --> --}}
                                            <div class="form-group">
                                                <label for="metro">Ближайшее метро</label>
                                                <input type="text" class="form-control" id="metro" name="submit-metro" placeholder="Укажите название станции метро рядом с Вами" required>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="address-map">Улица</label>
                                                <input type="text" class="form-control" id="address-map" name="submit-address" placeholder="Введите адрес в свободной форме" required>
                                            </div><!-- /.form-group -->

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <iframe src="https://static-maps.yandex.ru/1.x/?ll=37.620070,55.753630&spn=0.003,0.003& \
&size=393,320&z=13&l=map&pt=37.620070,55.753630,pmwtm1" width="100%" height="320" frameborder="0"></iframe>
                                                    </div><!-- /.form-group -->
                                                </div>
                                            </div>
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
                      <select name="submit-status" id="submit-status">
                        <option value="1">Обмен</option>
                        <option value="2">Обмен продажа</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col-md-6 -->
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <label for="submit-status">Цель обмена</label>
                      <select name="submit-tseli-obmena" id="submit-status">
                        <option value="1">На увеличение</option>
                        <option value="2">На уменьшение</option>
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

                        <option value="1">В своём районе</option>
                        <option value="2">В другом районе</option>

                      </select>
                    </div>
                  </div>
                  <!-- /.col-md-6 -->
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="submit-price">Предположительная цена объекта</label><i class="fa fa-question-circle tool-tip" data-toggle="tooltip" data-placement="right" title="Мы можем помочь в определении рыночной цены объекта"></i>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                        <input type="text" class="form-control" id="submit-price" name="predpolozhitelnaya_tsena" pattern="\d*">
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
                          <input type="text" class="form-control" id="submit-price" name="doplata" pattern="\d*">
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
          <hr>
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
  <div class="row">
    <div class="block clearfix">
      <div class="col-md-9 col-sm-9">
        <section id="submit-form">
          <section class="block" id="gallery">
            <header>
              <h2>Фотографии</h2></header>
            <div class="center">
              <div class="form-group">
                <input id="file-upload" name="file-upload[]" type="file" class="file" multiple="true" enctype="multipart/form-data"
                data-show-upload="false" data-show-caption="false" data-show-remove="false" 
                data-browse-class="btn btn-white2" data-browse-label="Загрузить изображения" accept="image/*">
                <figure class="note"><strong>Совет:</strong>Загрузите фотографии вашего жилья в формате jpeg или png!</figure>
              </div>
            </div>
          </section>
        </section>
      </div>
      <!-- /.col-md-9 -->
      <div class="col-md-3 col-sm-3">
        </br>
        </br>
        <aside class="submit-step">
          <figure class="step-number">3</figure>
          <div class="description">
              <h4>Загрузите фотографии</h4>
              <p>Загрузите несколько красивых фотографий вашего объекта. От качества фотографий зависит какое впечатление составят об объекте.  </p>
          </div>
        </aside>
        <!-- /.submit-step -->
      </div>
      <!-- /.col-md-3 -->
    </div>
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="block">
      <div class="col-md-9 col-sm-9">
        <div class="center">
          <div class="form-group">
            <button type="submit" class="btn btn-success large">Отправить данные</button>
          </div>
          <!-- /.form-group -->
          <figure class="note block">Нажимая кнопку “Отправить данные” Вы подтверждаете, что уведомлены и согласны с <a href="{{url('/terms-conditions')}}">Правилами нашего сайта</a></figure>
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
