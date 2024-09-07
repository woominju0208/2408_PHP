-- 100000번 사원의 연봉을 4000만원으로 변경
-- 기존의 데이터를 남겨야 하기 때문에 UPDATE가 아닌 INSERT 로 추가
-- 기존의 데이터의 updated_at, end_at 은 UPDATE로 바꿔줘야 한다
INSERT INTO salaries (
	emp_id
	,salary
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100000
	,40000000
	,date(NOW())
	,NULL 
	,NOW()
	,NOW()
	,NULL 
)
;
-- start_at 의 데이터 타입은 DATE기 때문에 DATE(now())이다 
-- created_at 이랑 updated_at 은 TIMESTAMP기 때문에 NOW()을 넣어도 된다 
-- NOW()가 날짜 시분초 들어가고 DATE(NOW())가 날짜만 들어간다

	
UPDATE salaries
SET
	end_at = '2024-09-06'
WHERE
	emp_id =100000
	and end_at IS NULL;
	
DELETE FROM salaries
WHERE
	emp_id=100000
	AND salary=40000000; 
	
UPDATE salaries
SET
	updated_at =NOW() 
WHERE
	emp_id =100000
	AND salary = 32860565;
	
-- ------------------ 풀이	
	
UPDATE salaries
SET
	updated_at = NOW()
	,end_at = DATE(NOW())
WHERE sal_id = 990339;

INSERT INTO salaries(
	emp_id
	,salary
	,start_at
)
VALUES (
	100000
	,40000000
	,DATE(NOW())
);
-- end_at , created_at, updated_at 은 default 값으로 알아서 들어갔다 

-- 가장 최근의 기준은 start_at의 역순(내림차순)
SELECT
	*
FROM salaries
WHERE emp_id = 90000
ORDER BY start_at DESC
LIMIT 1
;

-- 서브쿼리를 이용해 제일 최신 데이터 내용 바꾸기
UPDATE salaries
SET
	updated_at = NOW()
	,end_at = DATE(NOW())
WHERE sal_id = (
					SELECT sal_id
					FROM salaries
					WHERE emp_id = 99999
					ORDER BY start_at DESC
					LIMIT 1
					)
;


-- 1. 사원별 전체 급여의 평균을 조회해 주세요.
SELECT
	salaries.emp_id
	,CEILING(AVG(salaries.salary)) avg_sal
FROM salaries
GROUP BY salaries.emp_id
;

-- 10. 현재 직책이 'T005'인, 사원의 사원번호와 이름을 조회해 주세요.
-- join 문
SELECT
	employees.emp_id
	,employees.name
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.title_code = 'T005'
			AND end_at IS null
ORDER BY title_emps.emp_id ASC
;
	
-- subquery 문
SELECT
	title_emps.emp_id
FROM title_emps
WHERE
	title_emps.title_code = 'T005'
	AND title_emps.end_at IS NULL;

SELECT
	employees.emp_id
	,employees.name		
FROM employees
WHERE
	emp_id IN (
					SELECT
						title_emps.emp_id
					FROM title_emps
					WHERE
						title_emps.title_code = 'T005'
						AND title_emps.end_at IS NULL
				)
ORDER BY employees.emp_id asc
;

-- 8. 사원별 전체 급여의 평균이 30,000,000 ~ 50,000,000인, 사원번호와 평균급여를 조회해 주세요.
SELECT
	salaries.emp_id
	,CEILING(AVG(salaries.salary)) avg_sal        
FROM salaries
WHERE salaries.end_at IS null
GROUP BY salaries.salary
HAVING
	avg_sal BETWEEN 30000000 AND 50000000		
;			
-- GROUP BY HAVING 절에 WHERE절도 쓸수 있다.
SELECT
	salaries.emp_id
	,CEILING(AVG(salaries.salary)) avg_sal        
FROM salaries
WHERE salaries.end_at IS null
GROUP BY salaries.salary
HAVING
	avg_sal BETWEEN 30000000 AND 50000000		
;

-- 6. 현재 각 부서의 부서장의 부서명, 이름, 입사일을 출력해 주세요.
SELECT
	departments.dept_name
	,emp.name
	,emp.hire_at
FROM employees emp
	JOIN department_managers dept_mg
		ON emp.emp_id = dept_mg.emp_id
			AND end_at IS null
	JOIN departments
		ON departments.dept_code = dept_mg.dept_code
;

INSERT INTO employees(
	
)
VALUES (

);

UPDATE employees
SET
WHERE
;
 
DELETE FROM employees
WHERE
;

CREATE DATABASE shop;

DROP DATABASE shop;	

CREATE TABLE users (
	id 			BIGINT(20) 			PRIMARY KEY  AUTO_INCREMENT 
	,NAME 		VARCHAR(50) 		NOT NULL
	,birth 		DATE 					NOT NULL 
	,addr 		VARCHAR(150) 		NOT NULL
	,gender 		CHAR(1) 				NOT NULL  COMMENT 'M = 남자, F = 여자'
	,tel 			VARCHAR(20) 		NOT null COMMENT '- 제외 숫자만'
	,created_at TIMESTAMP 			NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP 			NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP 			NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE users (
	id			BIGINT(20) UNSIGNED		PRIMARY KEY		AUTO_INCREMENT 
	,NAME		VARCHAR(50)		NOT NULL
	,addr		VARCHAR(150)	NOT NULL
	,gender	CHAR(1)			NOT NULL		COMMENT 'M = 남자, F = 여자'
	,tel		VARCHAR(20)		NOT NULL		COMMENT '- 제외 숫자'
	,created_at	TIMESTAMP	NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,updated_at	TIMESTAMP	NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,deleted_at	TIMESTAMP			
);

DROP TABLE users;

INSERT INTO users(			 
	NAME		
	,addr		
	,gender	
	,tel		
	,created_at	
	,updated_at	
)
VALUES (
	'농담곰'		
	,'농담곰마을 105-1203'		
	,'M'	
	,'010-9137-6458'		
	,NOW()	
	,NOW()		
);
