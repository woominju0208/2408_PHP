-- 프로시저 생성
-- DELIMITER 뒤에 띄어쓰기 필수!
-- ()는 이 함수를 실행 시키겠다 라는 의미 > add_emp()
-- parameter 외부에서 내가 전달된 값
-- SET @cup CUP이란 이름이 변수
-- DECLARE 변수생성(변수엔 하나의 데이터만 들어감)
-- SELECT emp_id
-- 	INTO @cup   컵에 들어있는건 emp_id 수 컴퓨터는 이미 사용한 데이터를 한번쓰면 없어지기 때문에
-- 					컵이라는 변수안에 emp_id 를 저장해두는것이다(여러 번 사용 가능)
	

DELIMITER $$

CREATE PROCEDURE add_emp(
	IN param_name VARCHAR(50)
	,IN param_birth VARCHAR(10)
	,IN param_gender CHAR(1)
)

BEGIN 
	DECLARE cup INT;
-- 	int 는 데이터타입 (숫자만 들어갈수있다 의미)
		
-- 	사원 테이블 입력
	INSERT INTO employees(
	name
	,birth
	,gender
	,hire_at
	)
	VALUES (
		param_name
		,param_birth
		,param_gender
		,DATE(NOW())
	);
	
	
-- 	방금 입력한 사원 번호 조회
	SELECT emp_id
	INTO @cup
	FROM employees
	ORDER BY emp_id DESC
	LIMIT 1
	;
	
-- 	급여 테이블 데이터 작성
	INSERT INTO salaries(
		emp_id
		,salary
		,start_at
	)
	VALUES (
		@cup
		,25000000
		,DATE(NOW())
	);
	
END $$

DELIMITER ;


-- 프로시저 실행
CALL add_emp('강아지', '2000-01-01', 'M');

-- 프로시저 삭제
-- 하나의 프로시저만 삭제 가능
DROP PROCEDURE add_emp;

