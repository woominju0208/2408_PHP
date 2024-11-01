const BTN_CALL = document.querySelector('#btn_call');
BTN_CALL.addEventListener('click', getList);


function getList() {
    const URL = document.querySelector('#url').value;
    console.log(URL);

    // GET
    // 체이닝 메소드 : .을 통해 연결연결해서 적는 메소드
    // resolve: 성공시 처리 (then) , reject: 실패시 처리 (catch)
    // response , error 이름은 바꿀수 있지만 기본적으로 이렇게 적는다.
    axios.get(URL)
    .then(response => { // 요청보낸게 돌아오면 then이 실행되고 오지 않으면 catch가 실행된다.
        // console.log(response);
            // console.log(response.data);
        response.data.forEach(item => {
            // console.log(item.download_url);
            const NEW = document.createElement('img');
            NEW.setAttribute('src', item.download_url);
            NEW.style.width = '200px';
            NEW.style.height = '200px';
            document.querySelector('.container').appendChild(NEW);
        });
    })
    .catch(error => {
        console.log(error);
    });
}

// 프론트쪽에서 url을 보내주면 백엔드는 url을 받고 데이터를 만들어서 
// 규칙을 가진 url을 백엔드에서 프론트로 보내준다.
// url의 규칙을 만들어서 보내주는거다.

// GET,POST 방식이 프론트와 백엔드의 요청 방법이다.(PHP에서만 쓰는게 아님)