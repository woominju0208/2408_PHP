<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST"){
    try {

        $conn = my_db_conn();
 
        // $file 을 $_FILE(이미지) 의 file 을 가져옴  
        $file = $_FILES["file"];

        if($file["name"]  === "") {
           $file_path = null; 
        } else {

            // 실제 현업 이미지 저장법! (이미지 이름 중복을 방지 하기 위해 랜덤이름을 지정해줌)
    
            $file_type = $_FILES["file"]["type"];
            // $file_type 이미지 확장자를 가져오기 위해 $_FILE(이미지) 의 file 과 type(jpg,png,web 등등...)을 가져옴
            $file_type_array = explode("/", $file_type);
            // explode 는 문자열을 배열로 변환하는 함수
            // $file_type_array에 파일이름/파일타입 이 배열로 담겼을 것이다.
            $extension = $file_type_array[1];
            // $file_type_array[1]; 을 가져오면 배열에 따라 파일이름[0]/파일타입[1] 로 $extension은 이미지의 파일타입만 가져오는것
    
            $file_path = "img/".uniqid().".".$extension;
            // uniqid() : 랜덤으로 이름 지정(이미지 이름 랜덤) => 유저가 올린 이미지 이름이 중복일수 있기 때문에 uniqid 로 랜덤 이름으로 DB저장
            // $file_path 는 $_SERVER["DOCUMENT_ROOT"]에 img폴더에 uniqid()(랜덤이름) 으로 .(연결) $extension(파일타입) 이라는 파일이 나온다.
            move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path);
            // move_uploaded_file은 DB에 저장할 이미지파일 이름으로 $file["tmp_name"]는 이미지의 임시저장소로 이걸 MY_PATH_ROOT.$file_path= htdocs에 img 폴더에 66fa5deab0534.jpeg 이런식으로 저장
            $file_path = "/".$file_path;
        }
        $conn->beginTransaction();

        $arr_prepare = [
            "title" => $_POST["title"]  
            ,"content" => $_POST["content"]
            ,"image" => $file_path
        ];

        my_board_insert($conn, $arr_prepare);

        $conn->commit();

        header("Location: /");
        exit;

    } catch(Throwable $th) {
        if(!is_null($conn)) {
            $conn->rollBack();
        }
        require_once(MY_PATH_ERROR);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>작성 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/insert.css">
</head>
<body>
    <?php
        require_once(MY_PATH_HEADER);
     ?>
    <main>
        <div class="main-list">
            <p>My Recipes</p>
        </div>
            <div class="item">
                <form action="/insert.php" method="post" enctype="multipart/form-data">
                    <div class="box title-box">
                        <div class="box-title">제목</div>
                        <div class="box-content">
                            <input type="text" name="title" id="title" required maxlength="9">
                        </div>
                    </div>
                    <div class="box content-box">
                        <div class="box-title">내용</div>
                        <div class="box-content">
                            <textarea name="content" id="content" required></textarea>
                        </div>
                    </div>
                    <div class="image-box">
                        <input type="file" name="file" id="file" accept="image/*" onchange="loadFile(this)">
                        <label for="file">👉 이미지 업로드 👈</label>
                    </div>
                    <div class="fileContainer">
                        <div class="fileInput">
                            <p>파일 이름: </p>
                            <p id="fileName"></p>
                        </div>
                        <div class="buttonContainer">
                            <div class="submitButton" id="submitButton">미리보기</div>
                        </div>
                    </div>
                    <div class="image-show" id="image-show"></div>
                    <script src="insert.js"></script>
                    <div class="main-footer">
                        <button type="submit" class="btn-small btn-eng">완료</button>
                        <a href="/"><button type="button" class="btn-small btn-eng">취소</button></a>
                    </div>
                </form>
            </div>
       
    </main>
</body>
</html>