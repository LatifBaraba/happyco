<?php
// Koneksi ke Database
// $conn = mysqli_connect("localhost","root","","admin");
$conn = mysqli_connect("localhost:8889","root","root","cocreative_db");

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
//require 'vendor/autoload.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function register($data) {
    global $conn;
    
	$username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    
	// cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    
	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
    }

	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
        return false;
        // var_dump($password);
    }
    
	// enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
	// tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");
    
	return mysqli_affected_rows($conn);
}

// -------------- ADD USER ---------------
//----------------------------------------
function adduser($data){

    global $conn;
    // ambil data dari tiap elemen dalam form
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
      
      if( mysqli_fetch_assoc($result) ) {
              $_SESSION['usernamesama']=1;
              return false;
      }
  
      // cek konfirmasi password
      if( $password !== $password2 ) {
        $_SESSION['passwordtidaksesuai']=1;
          return false;
          // var_dump($password);
      }
      
      // enkripsi password
      $password = password_hash($password, PASSWORD_DEFAULT);
      
      // tambahkan userbaru ke database
      // mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");
      // $id = $_POST['id'];
      // cek email validation
      $email  = $_POST['email'];
      // $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
      // var_dump($email);
      // var_dump($emailB);
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)       
      ) {
          // echo "<script>
          //      alert('Email is invalid!');
          //      document.location.href = 'adduser.php';
          //      </script>";
          $_SESSION['emailinvalid']=1;
          // var_dump('dalam');
          //exit();
          // header('Location: adduser.php?id='.$id);
          return false;
      }
  
    // query insert data
    $query = "INSERT INTO user VALUES 
    ('','$username','$email','$alamat','$telepon','$password')";
    $simpan = mysqli_query($conn,$query);
    if (!$simpan){        
      $_SESSION['gagaltambah']= 1;    
    }else {
      $_SESSION['berhasiltambah']= 1;
    }
  
    return mysqli_affected_rows($conn);
  }

  function hapus($id){
      global $conn ;
      mysqli_query($conn, "DELETE FROM user WHERE id=$id");
  
      return mysqli_affected_rows($conn);
  }
  
  function edituser($data) {
      global $conn;
  
      $id = $data["id"];
      // ambil data dari tiap elemen dalam form
      $username = htmlspecialchars($data["username"]);
      $email = htmlspecialchars($data["email"]);
      $alamat = htmlspecialchars($data["alamat"]);
      $telepon = htmlspecialchars($data["telepon"]);
      // $password = mysqli_real_escape_string($conn, $data["password"]);
  
          // query insert data
      $query = "UPDATE user SET
                  username = '$username',
                  email = '$email',
                  alamat = '$alamat',
                  telepon = '$telepon'
              WHERE id = '$id';
      ";
      mysqli_query($conn,$query);
  
      return mysqli_affected_rows($conn);
  }

  function changepass($data) {
    global $conn;
    $id = $_POST["id"];

    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    if( $password !== $password2 ) {
        $_SESSION['passnotmatch']= 1 ;
        return false;
        // var_dump($password);
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "UPDATE user SET
                    password = '$password'
                WHERE id = '$id';
        ";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);

        }
    }

function deleteuser($id){
    global $conn ;
    mysqli_query($conn, "DELETE FROM user WHERE id=$id");

    return mysqli_affected_rows($conn);
}

function deleteevent($id){
    global $conn ;
    mysqli_query($conn, "DELETE FROM event WHERE id=$id");

    return mysqli_affected_rows($conn);
}

    // ------------- Tambah Logo -------------
//----------------------------------------
function addlogo(){
    global $conn;
     // upload gambar
     $gambar = uploadlogo();
     if( !$gambar ){
           return false;}

     // query insert data
     $query = "INSERT INTO logo VALUES 
     ('','$gambar')";

     mysqli_query($conn,$query);
     return mysqli_affected_rows($conn);
}

function uploadlogo(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
        
    }

    //cek ukuran max size
    if($ukuranFile > 2000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }

    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/logo/' . $namaFileBaru);

    return $namaFileBaru;
}

function editaboutus($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);
    $paragraf = htmlspecialchars($data["paragraf"], ENT_QUOTES);

        // query insert data
    $query = "UPDATE visi SET
                judul = '$judul',
                paragraf = '$paragraf'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function editsocial($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data["nama"],ENT_QUOTES);
    $link = htmlspecialchars($data["link"],ENT_QUOTES);

        // query insert data
    $query = "UPDATE social SET
                nama = '$nama',
                link = '$link'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function editbooking($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $telepon = htmlspecialchars($data["telepon"],ENT_QUOTES);

        // query insert data
    $query = "UPDATE book SET
                telepon = '$telepon'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function editourproduct($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);
    $paragraf = htmlspecialchars($data["paragraf"], ENT_QUOTES);

        // query insert data
    $query = "UPDATE product SET
                judul = '$judul',
                paragraf = '$paragraf'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function uploadicon($data){
    global $conn;

    $id = $data["id"];
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 2000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/ourproduct/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    $query = "UPDATE product SET
                gambar = '$namaFileBaru' WHERE id = '$id';
    ";
    // $query = "UPDATE product VALUES 
    // ('','$namaFileBaru','','') WHERE 'id'= $id ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function uploadgambarcontact($data){
    global $conn;

    $id = $data["id"];
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 3000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/social/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    $query = "UPDATE contact SET
                gambar = '$namaFileBaru' WHERE id = '$id';
    ";
    // $query = "UPDATE product VALUES 
    // ('','$namaFileBaru','','') WHERE 'id'= $id ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function editcreative($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);

        // query insert data
    $query = "UPDATE creative SET
                judul = '$judul'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function uploadicon_creative($data){
    global $conn;

    $id = $data["id"];
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 2000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/oncocreative/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    $query = "UPDATE creative SET
                gambar = '$namaFileBaru' WHERE id = '$id';
    ";
    // $query = "UPDATE product VALUES 
    // ('','$namaFileBaru','','') WHERE 'id'= $id ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function editslider($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);
    $paragraf = htmlspecialchars($data["paragraf"], ENT_QUOTES);

        // query insert data
    $query = "UPDATE slider SET
                judul = '$judul',
                paragraf = '$paragraf'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function editcontact($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data["nama"],ENT_QUOTES);
    $alamat = htmlspecialchars($data["alamat"],ENT_QUOTES);
    $telepon = htmlspecialchars($data["telepon"], ENT_QUOTES);
    $email = htmlspecialchars($data["email"]);

    // query insert data
    $query = "UPDATE contact SET
                nama = '$nama',
                alamat = '$alamat',
                telepon = '$telepon',
                email = '$email'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function uploadslider($data){
    global $conn;

    $id = $data["id"];
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 3000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/slider/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    $query = "UPDATE slider SET
                gambar = '$namaFileBaru' WHERE id = '$id';
    ";
    // $query = "UPDATE product VALUES 
    // ('','$namaFileBaru','','') WHERE 'id'= $id ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function uploadgallery($data){
    global $conn;

    $id = $data["id"];
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 3000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/gallery/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    $query = "UPDATE gallery SET
                gambar = '$namaFileBaru' WHERE id = '$id';
    ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function editgallery($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);
    $ketjudul = htmlspecialchars($data["ketjudul"],ENT_QUOTES);
    $paragraf = htmlspecialchars($data["paragraf"],ENT_QUOTES);

        // query insert data
    $query = "UPDATE gallery SET
                judul = '$judul',
                ketjudul = '$ketjudul',
                paragraf = '$paragraf'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function uploadalbum($data){
    global $conn;

    $id = $data["id"];
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 3000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/album/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    $query = "UPDATE album SET
                gambar = '$namaFileBaru' WHERE id = '$id';
    ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function editalbum($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);
    $caption = htmlspecialchars($data["caption"],ENT_QUOTES);

        // query insert data
    $query = "UPDATE album SET
                judul = '$judul',
                caption = '$caption'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function deletealbum($id){
    global $conn ;
    mysqli_query($conn, "DELETE FROM album WHERE id=$id");

    return mysqli_affected_rows($conn);
}

function uploadevent($data){
    global $conn;

    $id = $data["id"];
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 3000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/event/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    $query = "UPDATE event SET
                gambar = '$namaFileBaru' WHERE id = '$id';
    ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function editevent($data) {
    global $conn;

    $id = $data["id"];
    $date = date('Y-m-d',strtotime($_POST['tanggal']));
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);
    $caption1 = htmlspecialchars($data["caption1"],ENT_QUOTES);
    $caption2 = htmlspecialchars($data["caption2"],ENT_QUOTES);
    $caption3 = htmlspecialchars($data["caption3"],ENT_QUOTES);

        // query insert data
    $query = "UPDATE event SET
                tanggal = '$date',
                judul = '$judul',
                caption1 = '$caption1',
                caption2 = '$caption2',
                caption3 = '$caption3'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function uploadaddpartner($data){
    global $conn;

    $nama = htmlspecialchars($data["nama"],ENT_QUOTES);
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 2000000){
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/partner/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    mysqli_query($conn, "INSERT INTO partners VALUES('', '$namaFileBaru', '$nama')");

    return mysqli_affected_rows($conn);
}

function uploadaddalbum($data){
    global $conn;

    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);
    $id_gambar = htmlspecialchars($data["id_gambar"],ENT_QUOTES);
    $caption = htmlspecialchars($data["caption"],ENT_QUOTES);
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 3000000){
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/album/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    mysqli_query($conn, "INSERT INTO album VALUES('','$id_gambar', '$namaFileBaru', '$judul', '$caption')");

    return mysqli_affected_rows($conn);
}

function addevent($data){
    global $conn;


    $date = date('Y-m-d',strtotime($_POST['tanggal']));
    // $date = explode('/', $_POST['tanggal']);
    // $date = date('Y-m-d');
    $judul = htmlspecialchars($data["judul"],ENT_QUOTES);
    $caption1 = htmlspecialchars($data["caption1"],ENT_QUOTES);
    $caption2 = htmlspecialchars($data["caption2"],ENT_QUOTES);
    $caption3 = htmlspecialchars($data["caption3"],ENT_QUOTES);
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 3000000){
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/event/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    mysqli_query($conn, "INSERT INTO event VALUES('', '$namaFileBaru', '$judul', '$date', '$caption1', '$caption2', '$caption3')");

    return mysqli_affected_rows($conn);
}

function editpartner($data) {
    global $conn;

    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data["nama"],ENT_QUOTES);

        // query insert data
    $query = "UPDATE partners SET
                nama = '$nama'
            WHERE id = '$id';
    ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function deletepartner($id){
    global $conn ;

    mysqli_query($conn, "DELETE FROM partners WHERE id=$id");

    return mysqli_affected_rows($conn);
  
}

function uploadeditpartner($data){
    global $conn;

    $id = $data["id"];
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar
    if( $error === 4){
            // echo "<script>
            //     alert('upload gambar dahulu');    
            // </script>";
            $_SESSION['uploadgambardulu']=1;
            return false;
    }   

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        //  echo "<script>
        //       alert('upload bukan gambar !');    
        //  </script>";
    $_SESSION['uploadbukangambar']=1;
    return false;
    }
    //cek ukuran max size
    if($ukuranFile > 2000000){
        // echo "<script>
        // alert('ukuran gambar terlalu besar !');    
        // </script>";
        $_SESSION['logoterlalubesar']=1;
        return false;
    }
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    // beres cek siap di upload
    move_uploaded_file($tmpName, 'asset/img/partner/' . $namaFileBaru);

    // return $namaFileBaru;

    //  query insert data
    $query = "UPDATE partners SET
                gambar = '$namaFileBaru' WHERE id = '$id';
    ";
    // $query = "UPDATE product VALUES 
    // ('','$namaFileBaru','','') WHERE 'id'= $id ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function kirimemail($post){

    //global $mail;
    $mail = new PHPMailer(true);
    $email = htmlspecialchars($post["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)       
    ) {

        $_SESSION['emailisinvalid']=1;
        return false;
    }

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'cocreativework@gmail.com';                     // SMTP username
        $mail->Password   = 'cocreative2019';                               // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465;   
        $mail->SMTPOptions = array (
            'ssl' => array (
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
          );
          
        // TCP port to connect to
        //Recipients
        $mail->setFrom('cocreativework@gmail.com', 'Admin');
        $mail->addAddress($email);               // Name is optional
        //$mail->addReplyTo('latifbaraba88@gmail.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Co Creative';
        // $mail->Body    = ' <a href="localhost/CoCreative2/AdminCocreative/change-pass.php?email='.$email.'">Click Here</a> to change ur Password ';
        $mail->Body    = ' <a href="http://cocreative.id/change-pass.php?email='.$email.'">Click Here</a> to change ur Password ';
       
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

            $_SESSION['emailberhasil']=1;
            // echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $_SESSION['emailgagal']=1;

    }
}

function submitemail($post){

    //global $mail;
    $mail = new PHPMailer(true);
    $name = htmlspecialchars($post["name"]);
    $email = htmlspecialchars($post["email"]);
    $subject = htmlspecialchars($post["subject"]);
    $comment = htmlspecialchars($post["comment"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)       
    ) {

        $_SESSION['emailisinvalid']=1;
        return false;
    }

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'cocreativework@gmail.com';                     // SMTP username
        $mail->Password   = 'cocreative2019';                               // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465;   
        $mail->SMTPOptions = array (
            'ssl' => array (
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
          );

        // TCP port to connect to
        //Recipients
        $mail->setFrom('cocreativework@gmail.com', 'Admin');
        $mail->addAddress('cocreativework@gmail.com');             // Name is optional
        //$mail->addReplyTo('latifbaraba88@gmail.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Co Creative Submit Email';
        // $mail->Body    = ' <a href="localhost/CoCreative2/AdminCocreative/change-pass.php?email='.$email.'">Click Here</a> to change ur Password ';

        $mail->Body = "From : " .$name. "<br>" . "Email : " .$email. "<br>" . "Subject : " .$subject. "<br>" . "Comment : " .$comment ;
       
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

            $_SESSION['emailberhasil']=1;
            // echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $_SESSION['emailgagal']=1;

    }
}


function changepassemail($data,$email) {
    global $conn;

    $email = htmlspecialchars($email);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    if( $password !== $password2 ) {
        $_SESSION['passtidaksama']= 1 ;
        return false;
        // var_dump($password);
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "UPDATE user SET
                    password = '$password'
                WHERE email = '$email';
        ";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);

    }
}

function editmemberprice($pricenew){
    global $conn;

    $id = $_POST["id"];
    
    // ambil data dari tiap elemen dalam form
    $judul = htmlspecialchars($_POST["judul"],ENT_QUOTES);
    $hargalama = htmlspecialchars($_POST["hargalama"], ENT_QUOTES);
    $diskon = htmlspecialchars($_POST["diskon"], ENT_QUOTES);
    $fitur1 = htmlspecialchars($_POST["fitur1"], ENT_QUOTES);
    $fitur2 = htmlspecialchars($_POST["fitur2"], ENT_QUOTES);
    $fitur3 = htmlspecialchars($_POST["fitur3"], ENT_QUOTES);
    $fitur4 = htmlspecialchars($_POST["fitur4"], ENT_QUOTES);
    $fitur5 = htmlspecialchars($_POST["fitur5"], ENT_QUOTES);
    $fitur6 = htmlspecialchars($_POST["fitur6"], ENT_QUOTES);
    $fitur7 = htmlspecialchars($_POST["fitur7"], ENT_QUOTES);
    $fitur8 = htmlspecialchars($_POST["fitur8"], ENT_QUOTES);
    $fitur9 = htmlspecialchars($_POST["fitur9"], ENT_QUOTES);
    $fitur10 = htmlspecialchars($_POST["fitur10"], ENT_QUOTES);
    
    // query insert data
    $query = "UPDATE memberprice SET
                judul = '$judul',
                hargalama = '$hargalama',
                harga = '$pricenew',
                diskon = '$diskon',
                fitur1 = '$fitur1',
                fitur2 = '$fitur2',
                fitur3 = '$fitur3',
                fitur4 = '$fitur4',
                fitur5 = '$fitur5',
                fitur6 = '$fitur6',
                fitur7 = '$fitur7',
                fitur8 = '$fitur8',
                fitur9 = '$fitur9',
                fitur10 = '$fitur10'
            WHERE id = '$id';
    ";
    // var_dump($query);
    mysqli_query($conn,$query);

    // var_dump($judul);
    // var_dump($query);

    return mysqli_affected_rows($conn);
}

function diskon(){

    $hargalama = $_POST['hargalama'];
    $diskon = $_POST['diskon'];

    // $hasil_diskon = (($diskon / 100) * $hargalama);
    $hasil_diskon = $hargalama - $diskon;
    $result = $hargalama - $diskon;
    return $result;
}

function rupiah($angka){

    $hasil_rupiah = "Rp " . number_format($angka, 0,'.','.');
    return $hasil_rupiah;

}