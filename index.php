<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Botões Interativos</title>
    <style>
        .botao {
            margin: 5px;
            padding: 10px 20px;
            border: 1px solid #ccc;
            cursor: pointer;
            background-color: =#008000;
        }
        #botaoNao {
            position: relative;
            background-color: =#ff0000;
        }
    </style>
</head>
<body>

<?php
// Iniciar a sessão para guardar a posição do botão
session_start();

if (!isset($_SESSION['position'])) {
    $_SESSION['position'] = 'left'; // Posição inicial do botão "não"
}

$botaoNaoPosition = $_SESSION['position'] == 'left' ? 'right' : 'left';
?>

<p>Você gostaria de continuar?</p>
<button class="botao" onclick="document.getElementById('formResposta').submit();">Sim</button>
<button id="botaoNao" class="botao" onclick="mudarPosicao();">Não</button>

<form id="formResposta" method="POST" action="">
    <input type="hidden" name="resposta" value="sim">
</form>

<script>
function mudarPosicao() {
    // Muda a posição do botão "não"
    const botaoNao = document.getElementById('botaoNao');
    botaoNao.style.position = 'absolute';
    botaoNao.style.top = Math.random() * 300 + 'px'; // Mudando a posição vertical
    botaoNao.style.left = Math.random() * 300 + 'px'; // Mudando a posição horizontal

    // Enviando a posição nova para o PHP
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("position=" + (botaoNao.style.left.includes('left') ? 'right' : 'left'));
}
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['position'])) {
    $_SESSION['position'] = $_POST['position'];
}
?>

</body>
</html>
