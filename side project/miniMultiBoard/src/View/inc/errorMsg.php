<div id="errorMsg" class="form-text text-danger">
    <?php 
        echo implode('<br>', $this->arrErrorMsg);   // implode : 배열을 문자열로 출력
        // 아직 controller 영역 안에 머무르기 때문에 $this->arrErrorMsg 를 사용할수 있게 된거다.

        // index 부터 시작해서 route로 가고 로그인 usercontroller에서 부모인 controller안에 머물러서 errormsg안은 지금 controller안에 존재한다.
    ?>
</div>