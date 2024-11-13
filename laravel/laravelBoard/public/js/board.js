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

            // modal 상세페이지 데이터 출력
                modalTitle.textContent = response.data.b_title;
                modalContent.textContent = response.data.b_content;
                modalCreatedAt.textContent = response.data.created_at;
                // 시간형태를 바꾸는건 model Board에서 작성
                modalImg.setAttribute('src', response.data.b_img);

                // 다른 모달을 보여줄때 그전 데이터가 보이지 않게 할려면 로딩창을 따로 띄워주고
                // 모달이 완성되면 창을 보여주는 디테일 처리를 해주고 싶으면 부트스트랩으론 로직이 어렵다.

            })
            .catch(errpr => {
                console.error(error);
            });

        });
    })
})();