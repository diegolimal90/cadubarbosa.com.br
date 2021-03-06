$(document).ready(function () {
    $("#btnEnviar").on("click", function () {
        $("#formContato").validate({
            rules: {
                strNome: {
                    required: true
                },
                strEmail: {
                    required: true,
                    email: true
                },
                strFone: {
                    required: true
                },
                strMensagem: {
                    required: true
                },
            },
            errorPlacement: function (error, element) {
                return true;
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass("has-success").addClass('has-error');
            },
            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                icon.removeClass("fa-warning").addClass("fa-check");
            },
            submitHandler: function (form) {
                var dados = $("#formContato").serialize();

                $.ajax({
                    url: '../php/solicita.php',
                    data: dados,
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                        $("#btnEnviar").html('AGUARDE...');
                        $("#btnEnviar").prop('disabled', true);
                    },
                    complete: function () {
                        $("#btnEnviar").html('SOLICITAR');
                        $("#btnEnviar").prop('disabled', false);
                    },
                    success: function (result) {
                        $("#contato_sucesso").hide();
                        $("#contato_erro").html(result.msg);
                        $("#contato_erro").show();

                        if (result.status == 'ok') {
                            // limpando o formulário
                            $("#formContato")[0].reset();
                        }
                    }
                });
            }
        });

    });

    $("#strCep").keyup(function () {

        if ($("#strCep").val().length >= 9) {

            valorCep = $("#strCep").val();

            $.ajax({
                url: 'https://viacep.com.br/ws/' + valorCep + '/json/',
                type: 'get',
                dataType: 'json',
                success: function (result) {
                    $("#strCidade").val(result.localidade);
                    $("#strBairro").val(result.bairro);
                    $("#strRua").val(result.logradouro);
                    $("#strComplemento").val(result.complemento);
                }
            });
        }
    })

    $("#strCep1").keyup(function () {

        if ($("#strCep1").val().length >= 9) {

            valorCep = $("#strCep1").val();

            $.ajax({
                url: 'https://viacep.com.br/ws/' + valorCep + '/json/',
                type: 'get',
                dataType: 'json',
                success: function (result) {
                    $("#strCidade1").val(result.localidade);
                    $("#strBairro1").val(result.bairro);
                    $("#strRua1").val(result.logradouro);
                    $("#strComplemento1").val(result.complemento);
                }
            });
        }
    })

});

function buscarCep() {
    //
}


function mascara(o, f) {
    v_obj = o
    v_fun = f
    setTimeout(execmascara(), 1)
}

function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}

function maskcep(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{5})(\d)/, "$1-$2");
    return v;
}

function masktelefone(v) {
    v = v.replace(/\D/g, "");
    if (v.length <= 8) {
        v = v.replace(/(\d{8})(\d)/, "$1-$2");
    } else {
        v = v.replace(/(\d{7})(\d)/, "$1-$2");
    }
    return v;
}


function masknumber(v) {
    v = v.replace(/\D/g, "");
    return v;
}