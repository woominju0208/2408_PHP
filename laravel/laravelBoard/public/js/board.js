(() => {
    document.querySelectorAll('.my-btn-detail').forEach(node => {
        node.addEventListener('click', e => {
            // 상세 버튼 클릭시 value를 가져옴
            const url ='/boards/' + e.target.value;

            // axios 사용
            // BoardController 에서 백엔드 작업함
            axios.get(url)
            .then(response => {
            // id 선택
                const modalTitle = document.querySelector('#modalTitle');
                const modalContent = document.querySelector('#modalContent');
                const modalCreatedAt = document.querySelector('#modalCreatedAt');
                const modalImg = document.querySelector('#modalImg');
                // 모달 삭제 버튼
                const modalDeleteParent = document.querySelector('#modalDeleteParent');

            // modal 상세페이지 데이터 출력
                modalTitle.textContent = response.data.b_title;
                modalContent.textContent = response.data.b_content;
                modalCreatedAt.textContent = response.data.created_at;
                // 시간형태를 바꾸는건 model Board에서 작성
                modalImg.setAttribute('src', response.data.b_img);

                // 처음부터 닫기를 가지고 있지만 안보이고 모달창을 누를시 보이게 만들기
                // 삭제버튼이 생겼으면 다른 모달에서도 그대로 있기 때문에 빈문자열 ''로 리셋
                modalDeleteParent.textContent = ''; 
                if(response.data.delete_flg) {
                    const newButton = document.createElement('button');
                    newButton.textContent = '삭제';
                    newButton.setAttribute('type', 'button');
                    newButton.setAttribute('class', 'btn btn-warning');
                    newButton.setAttribute('onclick', `boardDestroy(${e.target.value})`);
                    // 모달 닫는 처리
                    newButton.setAttribute('data-bs-dismiss', 'modal');

                    // modalDeleteParent의 자식 부분에 버튼 추가
                    modalDeleteParent.appendChild(newButton);

                }

                // 다른 모달을 보여줄때 그전 데이터가 보이지 않게 할려면 로딩창을 따로 띄워주고
                // 모달이 완성되면 창을 보여주는 디테일 처리를 해주고 싶으면 부트스트랩으론 로직이 어렵다.

            })
            .catch(error => {
                console.error(error);
            });

        });
    })
})();

// svg onclick의 redirectInsert로 이동처리 
function redirectInsert($type) {
    window.location = '/boards/create?bc_type=' +$type; //  $type 는 redirectInsert(0)에 0을 적어서 0 으로 출력
}

// 게시글 삭제 처리(axios 처리)
function boardDestroy($id) {
    const url = '/boards/' + $id;   // 상수 url에 HTTP METHOD 의 DELETE 의 path(boards/{board})를 가져옴

    axios.delete(url) // url 을 백엔드로 보내고 백엔드(route, BoardController) 후에 65라인 부터 실행
    .then(response => {
        if(response.data.success) {
            // deleteNode에 특정 카드의 데이터를 넣음
            const deleteNode = document.querySelector('#card' + $id);
            // 특정카드를 삭제 > 프론트 쪽만 처리 DB는 삭제아님
            deleteNode.remove();
        } else {
            alert('삭제 실패');
        }
    })
    .catch(error => {
        console.log(error);
        alert('에러 발생');
    });

}