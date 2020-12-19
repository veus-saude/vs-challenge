<script>
    //Via cep
    $(document).ready(function() {

        function limpa_formulario_cep() {
            // Limpa valores do formulário de cep.
            $(".street").val("");
            $(".district").val("");
            $(".city").val("");
            $(".state").val("");
            $(".ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $(".cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $(".street").val("...");
                    $(".district").val("...");
                    $(".city").val("...");
                    $(".state").val("...");
                    $(".ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            if(dados.logradouro)
                            {
                                $(".street").val(dados.logradouro).prop("readonly", true);
                            }
                            if(dados.bairro)
                            {
                                $(".district").val(dados.bairro).prop("readonly", true);
                            }
                            if(dados.localidade)
                            {
                                $(".city").val(dados.localidade).prop("readonly", true);
                            }
                            if(dados.uf)
                            {
                                $(".state").val(dados.uf).attr("readonly", true);
                            }

                            $(".ibge").val(dados.ibge).prop("readonly", true);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulario_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulario_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulario_cep();
            }
        });
    });
</script>
