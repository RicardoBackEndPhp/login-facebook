<!DOCTYPE html>
<!--
    Documento criado por Ricardo de Oliveira com base na API de login do facebook para uso com ajax.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login com Facebook</title>
    </head>
    <body>
        <script>
        
        //Iniciando configurações para a API facebook
        window.fbAsyncInit = function() 
        {
            FB.init({
                appId      : '161077704610258', //sua chave do facebook
                cookie     : true,  // enable cookies to allow the server to access 
                                    // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.9' // use graph api version 2.8
            });

            checkLoginState(); //chama a verificação direta
        };

        //Load the SDK asynchronously - Configuração do SDK
        (function(d, s, id) 
        {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        
        
        //Verificando resposta do facebook.
        function statusChangeCallback(response) 
        {
            console.log(response);
            
            // for FB.getLoginStatus().
            if (response.status === 'connected') 
            {
                // Logged into your app and Facebook.
                testAPI();
            } 
            else 
            {
                // The person is not logged into your app.
                document.getElementById('status').innerHTML = 'Please log ' + 'into this app.'; //teste
            }
        }

        //Recebendo dados.
        function testAPI() 
        {            
            FB.api('/me',{fields: "id,picture,email,first_name,name"},  function(response) 
            {
                //console.log('Successful login for: ' + response.name);
                
                console.log(response);
                document.getElementById('status').innerHTML = 'Logado com email: ' + response.email + ' !'; //teste
            });
        }
        
        //métodos de acesso-----------------------------------------------------

        // Acesso direto - sem chamar tela de login
        function checkLoginState() 
        {
            FB.getLoginStatus(function(response) {
              statusChangeCallback(response);
            });
        }
        
        //acesso por ação (onclick) - chama tela de login
        function fbLogin() 
        {
            FB.login(function(response){
                statusChangeCallback(response);
            });
        }
        
    </script>

      <!--
        Botão de teste
      -->      
      <button onlogin="checkLoginState();" onclick="fbLogin()" >Logar com Facebook</button>
      
      <div id="status"></div>
    </body>
</html>
