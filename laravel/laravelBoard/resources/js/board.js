(() => {
    document.querySelectorAll('.my-btn-detail').forEach(node => {
        node.addEventListener('click', e => {
            const URL = '/boards/detail?b_id=' + e.target.value;
            // 오타안나게 조심하자...
            
        // Ajax를 사용하는데 거기에 axios라는 라이브러리를 사용하고 JSON형태로 데이터를 보내줄것이다.
        // 실제로는 클라이언트 사이드 렌더링 과 서버 사이드 렌더링 둘중 하나만 쓴다.
            axios.get(URL)
            .then(response => {
                const TITLE = document.querySelector('#modalTitle');
                const CONTENT = document.querySelector('#modalContent');
                const IMG = document.querySelector('#modalImg');
                const NAME = document.querySelector('#modalName');

                // title 출력
                TITLE.textContent = response.data.b_title;
                 // content 출력
                CONTENT.textContent = response.data.b_content;
                 // img 출력
                IMG.setAttribute('src', response.data.b_img);
                 // name 출력
                NAME.textContent = response.data.u_name;

            })
            .catch(error => {
                console.log(error);
            });
        });
    });


    // svg 클릭시 게시글작성으로 이동
    document.querySelector('#btnInsert').addEventListener('click', () => {
        window.location = '/boards/insert?bc_type=' + document.querySelector('#inputBoardType').value;
    });
})();
