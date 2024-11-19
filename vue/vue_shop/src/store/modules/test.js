export default {
    namespaced: true,
    state: () => ({
        products: [
            {productName: '바지', productAmount: 5, productPrice: 38000, productContent: '매우 아름다운 바지'}
            ,{productName: '티셔츠', productAmount: 10, productPrice: 25000, productContent: '매우 아름다운 티셔츠'}
            ,{productName: '양말', productAmount: 7, productPrice: 39999, productContent: '매우 비싼 양말'}
        ],
        detailProduct: {productName: '', productAmount: 0, productPrice: 0, productContent: ''}
        
    }),
    mutations: {
        popupDetailProduct(state, item) {
            state.detailProduct = item;
        }
    },
    actions: {

    },
    getters: {

    },
}