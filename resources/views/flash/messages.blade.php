@if(session()->has('message_flash'))

    <script>
        swal({
            title: "{{ session(flash_message.title) }}",
            text:  "{{ session(flash_message.message) }}",
            type:  "{{ session(flash_message.level) }}",
            timer:  1700,
            showConfirmButton: false
        });
    </script>
    
@endif



@if(session()->has('is_not_owner'))

    <script>
        /*swal({
            title: "Осторожно !",
            text: "Чтобы написать владельцу, надо разместить оъявление",
            type: "warning",
            timer:  2500,
            showConfirmButton: false
        });*/


        swal({
            title: "У вас нет объявлении",
            text: "Вы не можете отправить личное сообщение владельцу объявлении.",
            type: "warning",
            confirmButtonColor: "#6CBF6C",
            confirmButtonText: "Разместить",
            showCancelButton: true,
            cancelButtonText: "К списку",
            closeOnConfirm: false
        },
         function(){
                var windowObjectReference;
                windowObjectReference = window.open("/dashboard/advertisement/add");  
        });
    </script>
    
@endif


@if(session()->has('is_not_auth'))
    <script>
        swal({
            title: "",
            text: "Надо войти на сайт или пройти быструю регистрацию",
            type: "info",
            timer:  2500,
            showConfirmButton: false
        });

        
    </script>
    
@endif

