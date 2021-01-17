<?php
require __DIR__ . '/Session.php';
require __DIR__ . '/Usuario.php';

$query = new Usuario('usuario');

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  
  $target_dir = "../user-uploads/images/";

// Utilizando hash de id do usuario + email para nome da foto
$dados_usuario = $query->selectUsuario($_SESSION['id']);
foreach ($dados_usuario as $usuario) {
  $nome = md5($usuario['id_usuario'].$usuario['nm_email']);
}

// Separando a extensão do nome da imagem
$extensao = substr(($_FILES["fileToUpload"]["name"]), -4);

// Concatenando o nome hash com a extensao
$nomeImagem = $nome . $extensao;

// Alterando o nome original da imagem 
$_FILES["fileToUpload"]["name"] = $nomeImagem;

$target_file = $target_dir . basename(($_FILES["fileToUpload"]["name"]));
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Se o usuário ja tiver imagem, irá excluír a antiga
  $dados_usuario = $query->selectUsuario($_SESSION['id']);
  foreach ($dados_usuario as $usuario) {
    if ($usuario['nm_caminho_foto'] != null) {
      removerImagem();
    }
  }

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    // echo "File is not an image.";
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    // echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
    header('LOCATION: ../view/perfil/perfil.php');
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

      $registros = $query->uploadImage($_SESSION['id'], basename($_FILES["fileToUpload"]["name"]));
      //var_dump(basename($_FILES["fileToUpload"]["name"]));
      //echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
      header('LOCATION: ../view/perfil/perfil.php');
    } else {
      //echo "Sorry, there was an error uploading your file.";
      header('LOCATION: ../view/perfil/perfil.php');
    }
  }
}

// Remover imagem
if (isset($_POST["remove"])) {
  removerImagem();
}

function removerImagem()
{
  // Buscar os dados do usuário
  $query = new Usuario('usuario');
  $dados_usuario = $query->selectUsuario($_SESSION['id']);
  // Remover foto do usuario
  foreach ($dados_usuario as $usuario) {
    if (!unlink('../user-uploads/images/' . $usuario['nm_caminho_foto'])) {
      echo ($usuario['nm_caminho_foto'] . " não foi deletada devido a um erro inesperado.");
    } else {
      $query->removeImageReference($_SESSION['id']);
      header('LOCATION: ../view/perfil/perfil.php');
    }
  }
}
