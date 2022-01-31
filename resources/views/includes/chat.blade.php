<div class='container'>
    <div class='card-post card-post-title'>
        <h3> Chat </h3>
    </div>
    <div class='container-chat' id='scroll'>
            <div id='chat_msg'>
                <img src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" alt="test" style="max-width: 20px;">
                Carregando...
            </div>
            @if (Auth::user() != null)
                <hr>
                <form class='form-inline' id='form_send_msg'>
                    <input type='text' id="msg" class='form-control' name='msg' autocomplete="off">
                </form>
                <button id="send_msg" class='btn btn-primary mb-2'>Enviar</button>
            @endif
    </div>
</div>


<script>
    var scroll = false;
    updateChat();
    function updateChat(loop = true) {
        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: "{{ route('site.updateChat') }}",
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(r) {
                $("#chat_msg").html(r);
                if (scroll == false) {
                    $("#scroll").scrollTop(9999999);
                    scroll = true;
                }

                if (loop == true) {
                    setTimeout(function() {
                        updateChat();
                    }, 3000);
                }
            },
            error: function(e) {
                console.log("Ocorreu um erro no update do chat: ");
                console.log(e)
            }
        });
    }

    $("#send_msg").click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: $('form[id="form_send_msg"]').serialize(),
            url: "{{ route('site.sendChat') }}",
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(r) {
                if (r.status == "SUCESSO") {
                    updateChat(false);
                    $("#msg").val("");
                }
                if (r.status == "ERRO") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: r.mensagem,
                        footer: '<a href="/">Deseja recarregar a página?</a>'
                    });
                }
            },
            error: function(e) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocorreu um erro ao enviar a mensagem',
                    footer: '<a href="/">Deseja recarregar a página?</a>'
                });

            }
        });
    });
    
</script>