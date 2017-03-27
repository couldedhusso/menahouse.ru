<div class="mail-box-header">
               <div class="mail-tools">
                   <h3>
                     <span class="font-noraml">От: </span>{{ Auth::user()->imia.' '.Auth::user()->familia }}
                   </h3>

                    <h3>
                     <span class="font-noraml">На: </span>{{ $auteurPlaintes->imia.' '.$auteurPlaintes->familia }}
                   </h3>
               </div>
</div>

<form action="/me/zhaloba" method="POST" class="form-contact-fields">
     <section id="contact">
                
                <div class="row">
                  <div class="col-md-9 col-sm-12">
                      <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                      <input name="auteurPlaintes" type="hidden" value="{!! $auteurPlaintes->id !!}" />

                      <div class="form-group">

                          <label for="form-causes-plainte">Причина жалоб</label>
                          <select name="causes" id="form-causes-plainte" >
                                <option value="1"> Рассылка спама</option>
                                <option value="2"> Оскорбительное поведение</option>
                                <option value="3"> Объявление размещено без согласия собственника</option>
                                <option value="4"> Есть объявление по другому адресу, но с такими же фотографими</option>
                                <option value="5"> Другие (в сообщении) </option>
                          </select>

                     </div><!-- /.form-group -->

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


    