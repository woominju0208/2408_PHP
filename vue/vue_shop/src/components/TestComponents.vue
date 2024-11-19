<template>
    <div v-for="item in products" :key="item">
        <h1 @click="openPopup">{{ item.productName }}</h1>
        <p>{{ item.productAmount }}개</p>
        <p>{{ item.productContent }}</p>
        <p>{{ item.productPrice }}원</p>
    </div>
</template>
<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

    const store = useStore();

    const products = computed(() => store.state.test.products);

    const detailProduct = computed(() => store.state.test.detailProduct);

    const openPopup = () => {
        // alert(store.commit('test/popupDetailProduct', item));
        alert(detailProduct);
    }
</script>
<style>
    
</style>