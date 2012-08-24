<?
error_reporting(E_ALL);
ini_set('display_errors', -1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
    <title>Parabéns Thaís!</title>
    <style type="text/css">
        body {background-color: #C5E4FF;height: auto;width: 100%;margin: 0;padding: 0;font-family: Arial, Helvetica, sans-serif;}
        #loading {position: fixed;background-color: #D00;top: 0;right: 0;padding: 5px;color: #FFF;font-size: 11px;z-index: 999999;}
        #hats {z-index: 9;width: 100%;height: 303px;background-color: transparent;position: absolute;top: 0;left: 0;background-image: url(images/hats.png);background-repeat: repeat-x;}
        #cloud {z-index: 1;width: 100%;height: 277px;background-color: transparent;position: absolute;top: 150px;left: 0;background-image: url(images/cloud.png);background-repeat: no-repeat;background-position: top center;}
        #content {width: 687px;margin: 480px auto 0 auto;}
            
            #boxButtonWriteAMessage {height: 60px;overflow: hidden;}
                button.writeAMessage {background-color: #069;padding: 15px;color: #FFF;border: none;font-weight: bold;width: auto;margin: 0 0 0 auto;display: block;cursor: pointer;background-image: url(images/shadow.png);background-repeat: repeat-x;font-size: 20px;border: solid 2px #069;}
                button.writeAMessage:hover {background-color: #09C;padding: 15px;color: #FFF;border: none;font-weight: bold;width: auto;margin: 0 0 0 auto;display: block;cursor: pointer;background-image: url(images/shadow.png);background-repeat: repeat-x;font-size: 20px;border: solid 2px #09C;}
            
            #writeAMessage {font-size: 12px;color: #333;padding: 10px;background-color: #FFF;margin: 0;display: none;}
                h1.newMessage {font-size: 18px;color: #666;font-weight: bold;margin-bottom: 25px;}
                input.input {border: solid 1px #CCC;margin: 5px 0 0 0;padding: 10px;width: 400px;color: #333;}
                textarea.textarea {border: solid 1px #CCC;margin: 5px 0 0 0;padding: 10px;width: 400px;color: #333;height: 80px;}
                .detailImage {font-size: 12px;color: #999;}
                button.saveMessage {background-color: #069;padding: 5px;color: #FFF;border: none;width: auto;margin: 0;cursor: pointer;}
                button.saveMessage:hover {background-color: #09C;padding: 5px;color: #FFF;border: none;width: auto;margin: 0;cursor: pointer;}
                a.cancelMessage,
                a.cancelMessage:link {color: #069;text-decoration: none;}
                a.cancelMessage:hover {color: #069;text-decoration: underline;}

            ul#comments {margin: 20px 0 0 0;padding: 0;list-style: none;}
                #comments li {list-style: none;margin: 0 0 2px 0;padding: 10px;background-color: #FFF;font-size: 13px;color: #333;}
                    .commentAuthor {font-size: 14px;color: #069;font-weight: bold;display: block;margin: 0 0 15px 0;}
                    .messageImage {display: block;margin-top: 10px;width: 660px;height: auto;overflow: hidden;}
                    
        #footer {background-image: url(images/graduates.png);background-repeat: repeat-x;height: 237px;width: 100%;overflow: hidden;margin-top: 0;}
    </style>

    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/corner.js"></script>
    <script type="text/javascript">
        $(function() {
            $("button.writeAMessage").corner("5px");
            $("#writeAMessage").corner("5px");
            $("input.input").corner("5px");
            $("textarea.textarea").corner("5px");
            $("button.saveMessage").corner("5px");
            
            getMessages();
        });
        
        function loading(action) { (action == 0) ? $('#loading').fadeOut() : $('#loading').fadeIn(); }
        
        function go(id) {
            $('html, body').animate({
                scrollTop: $("#" + id).offset().top
            }, 1000);
        }
        
        function getMessages() {
                loading(1);
                $('ul#comments').load('scripts/getMessages.php', function() {
                    loading(0);
                });
                
                setTimeout("getMessages()",20000);
                loading(0);
            }
        
        function writeAMessage(action,withGo) {
            loading(1);
            if ( action == 1 ) {
                $('button.writeAMessage').fadeOut()
                $('#writeAMessage').slideDown("normal");
                if ( withGo == 1 )
                    go('writeAMessage');
            } else {
                $('button.writeAMessage').fadeIn();
                $('#writeAMessage').slideUp("normal");
                if ( withGo == 1 )
                    go('boxButtonWriteAMessage');
            }
            loading(0);
        }
        
        function validateEmail(email) {
            if ((email.length == 0) || (email.length < 5) || (email.indexOf("@") < 3))
                return false;
            else
                return true;
        }
        
        function saveMessage() {
            loading(1);
            var name = $('#newName');
            var email = $('#newEmail');
            var message = $('#newMessage');
            var image = $('#newImage');
            
            if ( name.val() == '' ) {
                alert('Qual é seu nome?');
                name.focus();
            } else if ( email.val() == '' ) {
                alert('Qual é seu e-mail?');
                email.focus();
            } else if ( !validateEmail(email.val()) ) {
                alert('E-mail inválido');
                email.focus();
            } else if ( message.val() == '' ) {
                alert('Escreva uma mensagem');
                message.focus();
            } else {
                $.ajax({
                    url: "scripts/saveMessage.php",
                    data: {
                        name: name.val(),
                        email: email.val(),
                        message: message.val(),
                        image: image.val(),
                    },
                    success: function(data) {
                        //alert("Mensagem salva!\nObrigado!");
                        go('content');
                        writeAMessage(0,0);
                        name.attr('value','');
                        email.attr('value','');
                        message.attr('value','');
                        image.attr('value','http://');
                        getMessages();
                    },
                    error: function(data) {
                        alert("Ocorreu algum erro. Por favor tente novamente em alguns instantes.\nDetalhes do erro: " + data);
                    }
                });
            }
            loading(0);
        }
    </script>

</head>
<body onload="loading(0)">
    <div id="loading">Carregando</div>
    <div id="hats">&nbsp;</div>
    <div id="cloud">&nbsp;</div>
    <div id="content">
        <div id="boxButtonWriteAMessage">
            <button class="writeAMessage" onclick="writeAMessage(1,1)">Deixe sua mensagem para a Thaís!</button>
        </div>
        
        <div id="writeAMessage">
            <h1 class="newMessage">Escreva algo pra Thaís</h1>
            Seu nome<br />
            <input type="text" class="input" value="" id="newName" maxlength="100" />
            <br /><br />
            Seu e-mail<br />
            <input type="text" class="input" value="" id="newEmail" maxlength="100" />
            <br /><br />
            O que você quer escrever para a Thaís?<br />
            <textarea cols="" rows="" class="textarea" id="newMessage"></textarea>
            <br /><br />
            Que tal colocar uma foto? <span class="detailImage">(Informe o link da imagem)</span><br />
            <input type="text" class="input" value="http://" id="newImage" />
            <br /><br />
            <button class="saveMessage" onclick="saveMessage()">Salvar</button> <a href="javascript:writeAMessage(0,1)" class="cancelMessage">&nbsp; Ou cancelar</a>
        </div>
        
        <ul id="comments"></ul>
    </div>
    <div id="footer">&nbsp;</div>
</body>
</html>