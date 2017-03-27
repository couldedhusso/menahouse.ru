
@extends('templates.TemplateDashboard')

@section('Title')
  Mena | Profile
@endsection

@section('active_breadcrumb')
  <li><a href="#">Настройки</a></li>
@endsection

@section('content')
  <section id="profile">
                        <header><h1>Персональные настройки</h1></header>
                        <div class="account-profile">
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <img alt="" class="image" src="assets/img/agent-01.jpg">
									<div class="center">
										<div class="form-group">
                                            <input id="file-upload" type="file" class="file" multiple="true" data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-default-small" data-browse-label="Выбрать файл">
                                            <figure class="note"><strong>Совет: </strong>Загрузите изображение формата jpeg или png!</figure>
										</div>
									</div>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <form role="form" id="form-account-profile" method="post" >
                                        <section id="contact">
                                            <h3>Контакты</h3>
                                            <dl class="contact-fields">
                                                <dt><label for="form-account-name">Ваше имя:</label></dt>
                                                <dd><div class="form-group">
                                                    <input type="text" class="form-control" id="form-account-name" name="form-account-name" required value="Сергей Усачёв">
                                                </div><!-- /.form-group --></dd>
                                                <dt><label for="form-account-phone">Номер телефона:</label></dt>
                                                <dd><div class="form-group">
                                                    <input type="text" class="form-control" id="form-account-phone" name="form-account-phone" value="+7(123) 456 7890">
                                                </div><!-- /.form-group --></dd>
                                                <dt><label for="form-account-email">Email:</label></dt>
                                                <dd><div class="form-group">
                                                    <input type="text" class="form-control" id="form-account-email" name="form-account-phone" value="mail@pochta.ru">
                                                </div><!-- /.form-group --></dd>
                                            </dl>
                                        </section>
                                        <section id="about-me">
                                            <h3>Краткая информация</h3>
                                            <div class="form-group">
                                                <textarea class="form-control" id="form-contact-agent-message" rows="5" name="form-contact-agent-message">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et dui vestibulum, bibendum purus sit amet, vulputate mauris. Ut adipiscing gravida tincidunt. Duis euismod placerat rhoncus.
Phasellus mollis imperdiet placerat. Sed ac turpis nisl. Mauris at ante mauris. Aliquam posuere fermentum lorem, a aliquam mauris rutrum.</textarea>
                                            </div><!-- /.form-group -->
                                        </section>
                                        <section id="social">
                                            <h3>Социальные сети</h3>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-vk"></i></span>
                                                    <input type="text" class="form-control" id="account-social-vk" name="account-social-vk">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-odnoklassniki"></i></span>
                                                    <input type="text" class="form-control" id="account-social-odnoklassniki" name="account-social-odnoklassniki">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                                    <input type="text" class="form-control" id="account-social-facebook" name="account-social-facebook">
                                                </div>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                                    <input type="text" class="form-control" id="account-social-twitter" name="account-social-twitter" >
                                                </div>
                                            </div><!-- /.form-group -->

                                            @can('wasbanned', Auth::user())

                                                <div class="form-group clearfix">
                                                     <button type="submit" class="btn pull-right btn-default" id="account-submit">Сохранить</button>
                                                </div><!-- /.form-group -->
                                                
                                            @endcan
                                            
                                        </section>
                                    </form><!-- /#form-contact -->
									<div class="block clearfix">
									<section id="change-password">
                                        <header><h2>Изменить пароль</h2></header>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <form role="form" id="form-account-password" method="post" >
                                                    <div class="form-group">
                                                        <label for="form-account-password-current">Текущий пароль</label>
                                                        <input type="password" class="form-control" id="form-account-password-current" name="form-account-password-current">
                                                    </div><!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label for="form-account-password-new">Новый пароль</label>
                                                        <input type="password" class="form-control" id="form-account-password-new" name="form-account-password-new">
                                                    </div><!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label for="form-account-password-confirm-new">Подтверждение пароля</label>
                                                        <input type="password" class="form-control" id="form-account-password-confirm-new" name="form-account-password-confirm-new">
                                                    </div><!-- /.form-group -->

                                                     @can('wasbanned', Auth::user())

                                                        <div class="form-group clearfix">
                                                            <button type="submit" class="btn btn-default" id="form-account-password-submit">Изменить пароль</button>
                                                        </div><!-- /.form-group -->
    
                                                     @endcan
                                                   
                                                </form><!-- /#form-account-password -->
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <strong>Совет:</strong>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et dui
                                                    vestibulum, bibendum purus sit amet, vulputate mauris.
                                                </p>
                                            </div>
                                        </div>
                                    </section>
									</div>
                                </div><!-- /.col-md-9 -->
                            </div><!-- /.row -->
                        </div><!-- /.account-profile -->
                    </section><!-- /#profile -->
@endsection
