-- 내장함수 : 데이터를 처리하고 분석하는데 사용하는 프로그램

-- 데이터 타입 변환 함수
-- CAST(값 AS 데이터타입)
-- CONVERT(값, 데이터타입)
SELECT 
	1234
	,CAST(1234 AS CHAR(4))
	,CONVERT(1234, CHAR(4))
;
-- 숫자를 문자열로 바꿀순 있지만 문자를 숫자로는 바꿀수 X

-- ------------------------------------------------
-- 제어 흐름 함수
-- IF(수식, 참일 때, 거짓일 때)
-- 수식의 참 또는 거짓에 따라 결과를 분기하는 함수(참 또는 거짓 2가지 상황) 
SELECT 
	emp_id
	,gender
	,IF(gender = 'M','남자','여자') AS ko_gender
FROM employees
;

-- IFNULL(수식1, 수식2)
-- 수식1이 NULL이면 수식2를 반환
-- 수식1이 NULL이 아니면 수식1을 반환
-- 데이터 타입을 맞춰서 사용(ex > 숫자열= 1 , 문자열= '1') 
SELECT 
	emp_id
	,fire_at
	,IFNULL(fire_at,'9999-01-01') AS fire_at_not_null
	,IFNULL(sup_id, 0)
FROM employees
;

-- NULLIF(수식1, 수식2)
-- 수식1과 수식2이 일치하는지 체크를 하고
-- 참이면 NULL을 반환, 거짓이면 수식1을 반환
SELECT
	emp_id
	,gender
	,NULLIF(gender,'F') 
FROM employees
;

-- CASE문
-- CASE 체크하려는 수식
-- 	WHEN 분기수식1 THEN 결과1
-- 	WHEN 분기수식2 THEN 결과2
-- 	ELSE 결과4
-- END

SELECT 
	emp_id
	,CASE gender
		WHEN 'M' THEN '남자'
		WHEN 'F' THEN '여자'
		ELSE '모름'
	END AS ko_gender
FROM employees
;
-- gender 는 when문 뒤엔 gender='m' dender='f'로 같은 요소기 때문에
-- 단축해서 CASE gender 로 적기가능
SELECT
	emp_id
	,salary
	,CASE
		WHEN salary <=30000000
				THEN '평범'
			ELSE '많다'
		END AS '빈부격차' 
FROM salaries
;
-- -------------------------------
-- 문자열 함수
-- CONCAT(문자열1, 문자열2....)
-- 문자열을 연결하는 함수
-- 문자열을 입력 해 문자열이 아니라 처리한 값이 문자열로 나와서 문자열 함수이다.
SELECT CONCAT('안녕하세요.', 'DB입니다.');

-- CONCAT_WS(구분자, 문자열1, 문자열2....)
-- 문자열 사이에 구분자를 넣어 연결하는 함수
-- 마지막 문자뒤엔 들어가지 않음 (문자열 사이에만 들어감)
SELECT CONCAT_WS(',','딸기','바나나','수박','자두','사과');

-- FORMAT(숫자, 소수점 자릿수)
SELECT FORMAT(50000, 0);
SELECT FORMAT(500.123456789, 2);

-- LEFT(문자열, 숫자)
-- 문자열을 왼쪽부터 숫자길이 만큼 잘라 반환
SELECT LEFT('ABCDEFG', 2);

-- RIGHT(문자열, 숫자)
-- 문자열을 오른쪽부터 숫자길이 만큼 잘라 반환
SELECT RIGHT('ABCDEFG', 2);

-- UPPER(문자열)
-- 소문자를 대문자로 변경
SELECT UPPER('abcdE');

-- LOWER(문자열)
-- 대문자를 소문자로 변경
SELECT LOWER('abcdE');

-- LPAD(문자열, 길이, 채울 문자열)
-- 문자열을 포함해 길이만큼 채울 문자열을 왼쪽에 삽입해 반환
-- 자주쓰임
SELECT LPAD('321', 5, '0');

-- RPAD(문자열, 길이, 채울 문자열)
-- 문자열을 포함해 길이만큼 채울 문자열을 오른쪽에 삽입해 반환
-- 자주쓰임
SELECT RPAD('123', 5, '0');

SELECT LPAD(emp_id, 10, '0')FROM employees;

-- TRIM(문자열)
-- 좌우 공백을 제거
-- 중간 공백은 제거 불가능
SELECT TRIM('   SAD   ');

-- RTRIM(문자열)
-- 우 공백을 제거
SELECT RTRIM('   SAD   ');
-- LTRIM(문자열)
-- 좌 공백을 제거
SELECT LTRIM('   SAD   ');
-- 파라미터 : 함수안에 들어가는 요소
-- TRIM(방향 문자열1 FROM 문자열2)
-- 방향을 지정해서 문자열 2에서 문자열 1을 제거하여 반환
-- 방향은 LEADING(좌),BOTH(좌우),TRAILING(우) 지정 가능
SELECT
	TRIM(BOTH 'ab' FROM 'abcdeab')
	,TRIM(LEADING 'ab' FROM 'abcdeab')
	,TRIM(TRAILING 'ab' FROM 'abcdeab');

-- SUBSTRING(문자열, 시작위치, 길이)
-- 문자열을 시작위치에서 길이만큼 잘라서 반환
-- 공백도 하나의 문자로 취급
SELECT SUBSTRING('abcdef', 3, 2);
SELECT SUBSTRING(' 고양이강아지', 3, 3);

-- SUBSTRING_INDEX(문자열, 구분자, 횟수)
-- 왼쪽부터 구분자가 횟수번째가 나오면 그 이후부터 버림
-- 횟수에 음수를 넣으면 오른쪽부터 적용
SELECT SUBSTRING_INDEX('미어캣_그린_테스트','_',1);
SELECT SUBSTRING_INDEX('미어캣_그린_테스트','_',-1);

-- ------------------------------------------------
-- 수학함수
-- CEILING(값): 올림
-- FLOOR(값): 버림
-- ROUND(값): 반올림
-- CEILING, FLOOR, ROUND는 무조건 정수값으로 나옴
SELECT CEILING(1.2), FLOOR(1.9), ROUND(1.5);

-- TRUNCATE(값, 정수)
-- 소수점 기준으로 정수위치까지 구하고 나머지는 버림
SELECT TRUNCATE(1.2345, 2);

-- ------------------------------------------------
-- 날짜 및 시간 함수
-- NOW() : 현재 날짜 및 시간을 반환(YYYY-MM-DD hh:mi:ss)
-- ()안에 숫자넣으면 밀리초까지 나옴 최대 6
SELECT NOW();

-- DATE(데이트형식의 값)
-- 해당 값을 YYYY-MM-DD 형식으로 변환
SELECT DATE(NOW());

-- ADDDATE(날짜1, INTERVAL 날짜2)
SELECT ADDDATE('2024-01-01', INTERVAL 1 YEAR);
SELECT ADDDATE('2024-01-01', INTERVAL -1 YEAR);
SELECT ADDDATE('2024-01-01', INTERVAL 1 MONTH);
SELECT ADDDATE('2024-01-01', INTERVAL -1 MONTH);
SELECT ADDDATE('2024-01-01', INTERVAL 1 WEEK);
SELECT ADDDATE('2024-01-01', INTERVAL -1 WEEK);
SELECT ADDDATE('2024-01-01', INTERVAL 1 DAY);
SELECT ADDDATE('2024-01-01', INTERVAL -1 DAY);
SELECT ADDDATE('2024-01-01', INTERVAL 1 HOUR);
SELECT ADDDATE('2024-01-01', INTERVAL 1 MINUTE);
SELECT ADDDATE('2024-01-01', INTERVAL 1 SECOND);

-- SUBDATE 는 ADDDATE의 반대 (1년전으로 설정)(ADDDATE로만 쓰자)

-- ------------------------------------------------
-- 집계 함수
-- SUM() :해당 컬럼의 합계 출력
-- MAX() : 해당 컬럼의 최대값 출력
-- MIN() : 해당 컬럼의 최소값 출력
-- AVG() : 해당 컬럼의 평균값 출력
-- COUNT(): 해당 컬럼의 총수를 출력
SELECT
	SUM(salary)
	,MAX(salary)
	,MIN(salary)
	,AVG(salary)
FROM salaries;

SELECT
	COUNT(fire_at)
-- count(컬럼명)	null 값은 포함하지 않은 레코드 값만 가져옴
	,COUNT(*)
-- count(*)	null 값 포함 레코드 모든 값을 가져옴
FROM employees;
SELECT 
	sum(hire_at)
FROM employees;
-- sup_id 의 모든 개수를 알고싶으면 *로 전체 표시를 하는게 맞다.

-- ------------------------------------------------
-- 순위 함수
-- RANK() OVER(ORDER BY 컬럼 DESC/ASC)
SELECT
	emp_id
	,salary
	,RANK() OVER(ORDER BY salary DESC) AS sal_rank
FROM salaries
LIMIT 5; 

-- ROW_NUMBER() OVER(ORDER BY 컬럼 DESC/ASC)
-- 레코드에 순위를 매겨 반환
-- 동일한 값이 있는 경우에도 각 행에 고유한 번호를 부여
SELECT
	emp_id
	,salary
	,ROW_NUMBER() OVER(ORDER BY salary DESC) AS sal_rank
FROM salaries
LIMIT 5;



-- 연습
SELECT SUBSTRING_INDEX('abd_kdk_dkd_kab','_' , 3);
SELECT TRIM(' 1234 ');

SELECT DATE(NOW());

SELECT LPAD (1234,5,0);
SELECT RPAD (1234,10,0);
SELECT CONCAT_WS(' ','안녕','하세요','만두','입니다');
SELECT CONCAT('안녕하세요','___','만두입니다');

SELECT emp_id
	,title_code
	,IFNULL(end_at,date(NOW())) AS end_at
FROM title_emps
;

SELECT emp_id
		,fire_at
,case 
when fire_at IS not NULL then 'fired'
ELSE fire_at
END AS ing
FROM employees
;

-- 연봉이 26000000원 이하 일때 null 로 처리
SELECT emp_id
		,salary
FROM salaries
WHERE salary <=26000000
;

-- if(조건 ,참 , 거짓)
SELECT
		emp_id
		,salary
 		,if(salary>=26000000, salary, NULL) AS low
FROM salaries; 