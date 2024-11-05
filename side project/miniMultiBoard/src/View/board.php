<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
    <!-- bootstrap css CDN -->
     <!-- php 로 전환후 css 상대경로로 수정 -->
     <link rel="stylesheet" href="/View/css/myCommon.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
    <!-- header -->
      <?php require_once('View/inc/header.php'); ?>
          <!-- main -->
          <div class="mt-5 mb-5 text-center">
              <h1><?php echo $this->getBoardName(); ?></h1>
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
              </svg>
          </div>
      <main>
        <?php
        // $this->getArrBoardList() => 데이터베이스 정보 
          foreach($this->getArrBoardList() as $item) {?>
            <div class="card">
              <img src="<?php echo $item['b_img'] ?>" class="card-img-top object-fit-cover" style="height: 300px;" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $item['b_title'] ?></h5>
                <p class="card-text"><?php echo $item['b_content'] ?></p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal">
                  상세
                </button>
              </div>
            </div>
        <?php } ?>
      </main>
    <!-- footer -->
      <footer class="fixed-bottom bg-dark text-light text-center p-3">저작권</footer>
        <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">개발자입니다.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>살려주세요</p>
                <br>
                <img src="./img/9aUQQ4YjU9vmKuHT_cZAL61VKpKsLolynnI46BhOZQuKxGJygZ6BJK2zTHoX3pcNQmmcfzcVEZQcythY1lRXBQ.webp" class="object-fit-cover card-img-top"  alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <!-- bootstrap js CDN -->
     <!-- defer 사용 x (오류가 날때가 있음) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>