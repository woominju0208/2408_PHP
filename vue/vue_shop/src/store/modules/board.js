// 모듈의 기본적인 형태
export default {
    namespaced: true,    // 모듈화 된 스토어의 네임스페이스 활성화, 어디에 있는 메소드인지 지정, namespaced는 무조건 true로 지정
    state: () => ({
        // 데이터가 저장되는 영역(여러개 넣기 가능)
        // key: value
        count: 0,
        products: [
            {productName: '바지', productPrice: 38000, productContent: '매우 아름다운 바지'}
            ,{productName: '티셔츠', productPrice: 25000, productContent: '매우 아름다운 티셔츠'}
            ,{productName: '양말', productPrice: 39999, productContent: '매우 비싼 양말'}
            ,{productName: '모자', productPrice: 500000, productContent: '매우 매우 비싼 모자'}
        ],
        detailProduct: {productName: '', productPrice: 0, productContent: ''}, 
    }),
    mutations: {
        // state의 데이터를 수정할 수 있는 함수들을 정의하는 영역(여러개 넣기 가능)
        // state의 값을 변경할려면 무조건 mutations를 통해 변경해야한다.
        addCount(state) {
            state.count++;
        },
        setDetailProduct(state, item) {
            state.detailProduct = item;
        },

    },
    actions: {
        // 비동기성 비즈니스 로직 함수를 정의하는 영역


    },
    getters: {
        // 추가처리를 하여 state의 데이터를 획득하기 위한 함수들을 정의하는 영역(원본 데이터는 유지)

    },
}