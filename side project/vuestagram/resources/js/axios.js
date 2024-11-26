// axios 처리를 모아둔 파일
import axios from "axios";

// axiosInstance 내맘대로 이름 설정 가능
const axiosInstance = axios.create({
    // 기본 URL 설정(설정안하면 default는 내가 있는 위치)
    // baseURL: '112.222.157.156:6515',

    // 기본 헤더 설정
    headers: {
        'Content-Type' : 'application/json',
    }
});

// 만든 axiosInstance 를 내보냄
export default axiosInstance;