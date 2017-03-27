
<div class="mail-box-header">
               <div class="mail-tools">
                   <h3>
                     <span class="font-noraml">От: </span>{{ Auth::user()->imia.' '.Auth::user()->familia }}
                   </h3>
               </div>
</div>

<form action="/me/restore-account" method="POST" class ="form-contact-fields">

               <section id="contact">
                
                <div class="row">
                  <div class="col-md-9 col-sm-12">
                      <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                     
                      <div class="mail-text">
                        <label for="form-account-name">Сообщение</label>
                        <textarea class="form-control" name="message" rows="8" placeholder="Текст сообщения" required></textarea>
                      </div><!-- /.mail-text -->
                      
                        <div class="form-group clearfix">
                          <br><br><br>
                          <button type="submit" class="btn btn-m-5 btn-white-grey-3 pull-right" id="form-contact-fields-submit">Отправить сообщения</button>
                       </div><!-- /.form-group -->

                  </div>

              </div>
              </section>
              <br><br>
</form>

{{-- {!! Form::open(array('route' => '/', 'method' => 'post', 'class' => '')) !!}
 
{!! Form::close() !!}
     --}}