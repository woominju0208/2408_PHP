<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
require_once(MY_PATH_DB_LIB);

$conn = null;

// if( $file["name"] === "") {
//     $arr_prepare = [
//         "id" => $id
//         ,"title" => $_POST["title"]
//         ,"content" => $_POST["content"]
//     ];
// }

try{
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET") {
        // GET 처리
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
        
        if($id < 1) {
            throw new Exception("파라미터 오류");
        }

    $conn = my_db_conn();

    $arr_prepare =[
        "id" => $id
    ];

    $result = my_board_select_id($conn, $arr_prepare);
    }else {

        
        // POST 처리

        $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
        $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
        $title = isset($_POST["title"]) ? $_POST["title"] : "";
        $content = isset($_POST["content"]) ? $_POST["content"] : "";
        $image = isset($_POST["image"]) ? $_POST["image"] : "";

        if($id < 1 || $title === "") {
            throw new Exception("파라미터 오류");
        }
        
        // $file = $_FILES["file"];  
        // $file_type = $_FILES["file"]["type"];
        // $file_type_array = explode("/", $file_type);
        // $extension = $file_type_array[1];
        // $file_path = "img/".uniqid().".".$extension;
        // move_uploaded_file($file["tmp_name"], MY_PATH_ROOT.$file_path);

        $conn = my_db_conn();

        $file = $_FILES["file"];

        $conn->beginTransaction();

        if($file["name"]  === "") {
            $arr_prepare = [
                "id" => $id
                ,"title" => $_POST["title"]
                ,"content" => $_POST["content"]
            ]; 

            my_board_update_not_img($conn, $arr_prepare);
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
            $file_path = $file_path;

            $arr_prepare = [
                "id" => $id
                ,"title" => $_POST["title"]
                ,"content" => $_POST["content"]
                ,"image" => "/".$file_path
            ];
            
            my_board_update($conn, $arr_prepare);
        }


        $conn->commit();

        header("Location: /detail.php?id=".$id."&page=".$page);
        exit;
    } 

}catch(Throwable $th) {
    if(!is_null($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    require_once(MY_PATH_ERROR);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>수정 페이지</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/update.css">
</head>
<body>
    <?php
        require_once(MY_PATH_ROOT."header.php");
    ?>
    <main>
        <div class="main-list">
            <p>My Recipes</p>
            <p><?php echo $result["id"] ?></p>
        </div>
            <div class="item">
                <form action="/update.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
                    <input type="hidden" name="page" value="<?php echo $page ?>">
                    <div class="box title-box">
                        <div class="box-title">제목</div>
                        <div class="box-content">
                            <input type="text" name="title" id="title" value="<?php echo $result["title"] ?>">
                        </div>
                    </div>
                    <div class="box content-box">
                        <div class="box-title">내용</div>
                        <div class="box-content">
                            <textarea name="content" id="content"><?php echo $result["content"] ?></textarea>
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
                    <img class="image-show-prev" src="<?php echo $result["image"] ?>" alt="">
                    <script src="insert.js"></script>
                </div>
                    <div class="main-footer">
                        <button type="submit" class="btn-small btn-eng">완료</button>
                        <a href="/detail.php?id=<?php echo $result["id"] ?>&page=<?php echo $page ?>"><button class="btn-small btn-eng" type="button">취소</button></a>
                    </div>
                </form>
            </div>
    </main>
</body>
</html>