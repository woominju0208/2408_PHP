// -----------------
// Date 객체
// -----------------

// 배열로 만들어서 인덱스 번호로 요일 반환 (소스코드를 덜 먹어 추천)
const dayToKorean = day => {
    const ARR_DAY = ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'];
    return ARR_DAY[day];

    //  조건문으로 요일 반환
    // switch(day) {
    //     case 0:
    //         return '일요일';
    //     case 1:
    //         return '월요일';
    //     case 2:
    //         return '화요일';
    //     case 3:
    //         return '수요일';    
    //     case 4:
    //         return '목요일';
    //     case 5:
    //         return '금요일';
    //     default:
    //         return '토요일';
    // }
};

// ---------------------------------------------------

// 현재 날짜 및 시간 획득
const NOW = new Date();
const TEST = new Date('2025-01-01 00:00:00');


// getFullYear() : 연도만 가져오는 메소드(yyyy)
const YEAR = NOW.getFullYear();
const YEAR2 = TEST.getFullYear();

// ---------------------------------------------------

// 앞에 0을 찍기 위한 함수
// Date 는 Number이기 때문에 padStart를 쓰기 위해 String으로 변환 후 사용
// padStart 는 PHP에 str_pad와 같다.
const addLpadZero = (num, length) => {
    return String(num).padStart(length, '0');
};

// ---------------------------------------------------

// 객체화가 되지 않으면 str.~ NOW.~ .이후에 사용할수 없다.
// javascript내의 내장 객체가 엄청 많다.
// string은 자동으로 객체화
// Number도 자동으로 객체화
// Date는 new Instance로 객체화 해서 사용

// getMoth() : 월을 가져오는 메소드, 0 ~ 11 반환
// 그래서 원하는 월을 가져오기 위해서는 + 1 해준다.
// const MONTH = String(NOW.getMonth() + 1).padstart(2, '0');
const MONTH = addLpadZero(NOW.getMonth() + 1, 2);

// getDate() : 일을 가져오는 메소드
const DATE = addLpadZero(NOW.getDate(), 2);

// getHours() : 시를 가져오는 메소드
const HOUR = addLpadZero(NOW.getHours(), 2);

// getMinutes() : 분을 가져오는 메소드
const MINUTE = addLpadZero(NOW.getMinutes(), 2);

// getSeconds() : 초를 가져오는 메소드
const SECOND = addLpadZero(NOW.getSeconds(), 2);

// getMilliseconds() : 미리초를 가져오는 메소드
// 미리초는 3글자 이기때문에 3
const MILLISECOND = addLpadZero(NOW.getMilliseconds(), 3);

// getDay() : 요일을 가져오는 메소드, 0(일) ~ 6(토) 리턴
const DAY = NOW.getDay();

// ---------------------------------------------------

// 최종 Date 출력
const FORMAT_DATE = `${YEAR}-${MONTH}-${DATE} ${HOUR}:${MINUTE}:${SECOND}.${MILLISECOND}, ${dayToKorean(DAY)}`;
console.log(FORMAT_DATE);

// ---------------------------------------------------

// getTime() : UNIX Timestamp를 반환하는 메소드 (미리초 단위)
console.log(NOW.getTime());

// ---------------------------------------------------

// 두 날짜의 차를 구하는 방법
const TARGET_DATE = new Date('2025-03-13 18:10:00');
const DIFF_DATE = Math.floor(Math.abs(NOW -TARGET_DATE) / 86400000);
// abs 절대값을 하지 않으면 음수(-)가 나와 절대값으로 바꿔줬다.
// 1000 * 60 * 60 * 24 = 86400000 (일 단위)
// 나눌 수를 모두 곱해서 값(86400000)을 낸후 그 값을 나눠줬다.
// 나눈 다음 버림으로 소수점을 빼고 값을 냈다.


// 2024-01-01 13:00:00 과 2024-05-30 00:00:00은 몇개월 후 입니까?
const TARGET_DATE2 = new Date('2024-01-01 13:00:00');
const TARGET_DATE3 = new Date('2025-05-30 00:00:00');
const DIFF_DATE2 = Math.floor(Math.abs(TARGET_DATE2  - TARGET_DATE3) / (1000 * 60 * 60 * 24 * 30));  
