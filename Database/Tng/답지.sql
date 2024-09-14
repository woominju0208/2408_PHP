-- 1. 사원 정보테이블에 자신의 정보를 적절하게 넣어주세요.
INSERT INTO employees (
	NAME
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	'우민주'
	,'2000-02-08'
	,'F'
	,DATE(NOW())
	,NULL
	,NULL
	,NOW()
	,NOW()
	,NULL
)
;
-- -----------------
-- default 값 전부 생략(값 넣어도 됨)
INSERT INTO employees(
	name
	,birth
	,gender
	,hire_at
)
VALUES (
	'미어캣'
	,'2000-01-01'
	,'M'
	,DATE(NOW())
)
;
-- 2. 월급, 직급, 소속부서 테이블에 자신의 정보를 적절하게 넣어주세요.
INSERT INTO salaries(
	emp_id
	,salary
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100001
	,50000000
	,DATE(NOW())
	,null
	,NOW()
	,NOW()
	,NULL
)
;

INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100001
	,'T001'
	,DATE(NOW())
	,null
	,NOW()
	,NOW()
	,NULL
)
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100001
	,'D001'
	,DATE(NOW())
	,null
	,NOW()
	,NOW()
	,NULL
)
;
-- 3. 짝궁의 것도 넣어주세요.
INSERT INTO employees (
	NAME
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	'김지민'
	,'2000-05-05'
	,'F'
	,DATE(NOW())
	,NULL
	,NULL
	,NOW()
	,NOW()
	,NULL
)
;

INSERT INTO salaries(
	emp_id
	,salary
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100005
	,60000000
	,DATE(NOW())
	,null
	,NOW()
	,NOW()
	,NULL
)
;

INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100005
	,'T001'
	,DATE(NOW())
	,null
	,NOW()
	,NOW()
	,NULL
)
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100005
	,'D001'
	,DATE(NOW())
	,null
	,NOW()
	,NOW()
	,NULL
)
;
	 	

-- 4. 나와 짝궁의 소속 부서를 D009로 변경해 주세요.
UPDATE department_emps
SET
	end_at = DATE(NOW())
	,updated_at = NOW()
 WHERE
 	emp_id = 100001
 	AND department_emps.end_at IS NULL
;

UPDATE department_emps
SET
	end_at = DATE(NOW())
	,updated_at = NOW()
 WHERE
 	emp_id = 100002
 	AND department_emps.end_at IS NULL
;

INSERT INTO department_emps (
	emp_id
	,dept_code
	,start_at
	,created_at
	,updated_at
)
VALUES (
	100001
	,'D009'
	,DATE(NOW())
	,NOW()
	,NOW()
)
;

INSERT INTO department_emps (
	emp_id
	,dept_code
	,start_at
	,created_at
	,updated_at
)
VALUES (
	100002
	,'D009'
	,DATE(NOW())
	,NOW()
	,NOW()
)
;
-- 항상 변경사항이 생길시 기존 데이터를 update로 수정하고 고칠 데이터를 insert해서
-- 새로 넣어줘야 한다.

-- 5. 짝궁의 모든 정보를 삭제해 주세요.
DELETE FROM employees
	WHERE emp_id=100002
;

DELETE FROM salaries
WHERE emp_id = 100002
;

DELETE FROM title_emps
WHERE emp_id = 100002
;

DELETE FROM department_emps
WHERE emp_id = 100002
;
-- ---------------------------------
-- 실제론 employees는 pk라서 하위 테이블 부터 삭제 해야한다
DELETE FROM salaries WHERE emp_id - 100002;
DELETE FROM department_emps WHERE emp_id - 100002;
DELETE FROM title_emps WHERE emp_id - 100002;
DELETE FROM employees WHERE emp_id - 100002;

-- 6. 'D009'부서의 관리자를 나로 변경해 주세요.
SELECT
	emp_id
FROM department_managers
	WHERE dept_code = 'D009'
		AND end_at IS NULL
;		
--	현재 'D009'부서의 관리자는 emp_id = 37107    

UPDATE department_managers
SET
	end_at = DATE(NOW())
	,updated_at = NOW()
WHERE	
	emp_id = 37107
	AND department_managers.end_at IS NULL
;
-- ------------------
UPDATE department_managers
SET
	end_at = DATE(NOW())
	,updated_at = NOW()
WHERE	
	department_managers.dept_code = 'D009'
	AND department_managers.end_at IS NULL
;

INSERT INTO department_managers(
	emp_id
	,dept_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES(
	100001
	,'D009'
	,DATE(NOW())
	,NULL
	,NOW()
	,NOW()
	,NULL
)	
;	 

-- 7. 오늘 날짜부로 나의 직책을 '대리'로 변경해 주세요.
UPDATE title_emps
SET 
	end_at = DATE(NOW())
	,updated_at = NOW()
WHERE
	emp_id = 100001
	AND title_emps.end_at IS NULL
;


INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES(
	100001
	,'T002'
	,DATE(NOW())
	,NULL
	,NOW()
	,NOW()
	,NULL
)
;

-- 나의 직책이 '대리'인지 확인
SELECT 
 *
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
WHERE
	title_emps.end_at IS NULL
	AND title_emps.emp_id = 100001 
;

-- 8. 최저 연봉 사원의 사번과 이름, 연봉을 출력해 주세요.(??? > group by 절 문법)
SELECT
	employees.emp_id
	,employees.name
	,MIN(salaries.salary) min_sal
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.end_at IS NULL
		AND employees.fire_at IS NULL 	
;		
-- --------------------------------------------
SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.end_at is NULL
		AND salaries.salary = (
			SELECT
				MIN(salaries.salary)
			FROM salaries
			where
				salaries.end_at IS NULL
		)
;
-- 서브쿼리 문으로 최저 연봉 출력 			


-- 9. 전체 사원의 평균 연봉을 출력해 주세요.
SELECT
	AVG(salaries.salary) avg_sal
FROM salaries
	JOIN employees
		ON employees.emp_id = salaries.emp_id
		AND salaries.end_at IS null
;	
-- group by 는 원하는 그룹의 모든 값을 도출할때 사용
-- group by ~을 기준으로 그룹을 지어줘
-- group by 적은 내용을 select에도 똑같이 적어줘야 한다
-- 하나의 값만 원한다면 group by 로 묶을 필요가 없다
-- --------------------------------------
SELECT
	AVG(salaries.salary)
FROM salaries
WHERE
	salaries.end_at IS NULL
;	

SELECT AVG(salaries.salary)
FROM salaries
	JOIN title_emps
		ON salaries.emp_id = title_emps.emp_id
		AND title_emps.title_code = 'T001'
		AND salaries.end_at IS NULL
;		

-- 10. 사번이 54321인 사원의 지금까지 평균 연봉을 출력해 주세요.
SELECT
	employees.emp_id
	,AVG(salaries.salary) avg_sal
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND employees.emp_id = 54321
GROUP BY salaries.emp_id
;

SELECT
	*
FROM salaries
	WHERE
		emp_id =54321
;
-- -----------------------------------------------
SELECT
	AVG(salaries.salary) avg_sal
FROM salaries
WHERE
	emp_id =54321
GROUP BY salaries.emp_id
;

-- 01.아래 구조의 테이블을 작성하는 SQL을 작성해 주세요.	
CREATE TABLE users(
	userid 		BIGINT(20) UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,username 	VARCHAR(30) 	NOT null
	,authflg 	CHAR(1) 			DEFAULT '0'
	,birthday 	DATE 				NOT NULL
	,created_at DATETIME 		DEFAULT CURRENT_DATE
)
;				
-- created_at 에 type은 DATETIME 이기에 default 에 currentDate 로 적혔다고 
-- currentDate 가 아닌 시간까지 나오는 CURRENT_TIMESTAMP를 적어줘야 함
CREATE TABLE users(
	userid 		BIGINT(20) UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,username 	VARCHAR(30) 	NOT null
	,authflg 	CHAR(1) 			DEFAULT '0'
	,birthday 	DATE 				NOT NULL
	,created_at DATETIME 		DEFAULT CURRENT_TIMESTAMP
)
;

-- 02.[01]에서 만든 테이블에 아래 데이터를 입력해 주세요.
INSERT INTO users(
	username
	,authflg
	,birthday
	,created_at
)
VALUES (
	'그린'
	,'0'
	,'2024-01-26'
	,DATE(NOW())
)
;
-- authflg , created_at은 default 값이 있어서 안써도 된다.

-- 03.[02]에서 만든 레코드를 아래 데이터로 갱신해 주세요.
UPDATE users
SET
	username = '테스터'
	,authflg = '1'
	,birthday = '2007-03-01' 
WHERE
	username = '그린'
;
-- ---------------------------------------------------------
UPDATE users
SET
	username = '테스터'
	,authflg = '1'
	,birthday = '2007-03-01' 
WHERE
	userid = 2
;
	
-- 04.[02]에서 만든 레코드를 삭제해 주세요.
DELETE FROM users
WHERE userid = 2
;


-- 05.[01]에서 만든 테이블에 아래 Column을 추가해 주세요.
ALTER TABLE users
ADD COLUMN addr VARCHAR(100) NOT NULL DEFAULT '-'
;


-- 06.[01]에서 만든 테이블을 삭제해 주세요.
DROP TABLE users
;

-- 07.아래 테이블에서 유저명, 생일, 랭크명을 출력해 주세요.
SELECT
	users.username
	,users.birthday
	,rankmanagement.rankname
FROM users
	JOIN rankmanagement
		ON users.userid = rankmanagement.userid
		AND users.userid = 1
		AND users.username = 'green'
		AND users.birthday = '2024-01-26'
		AND rankmanagement.rankname = 'manager'		 
;

-- ------------------------------------------------
SELECT
	users.username
	,users.birthday
	,rankmanagement.rankname
FROM users
	JOIN rankmanagement
		ON users.userid = rankmanagement.userid
;
-- sample 데이터의 내용을 and조건문 써서 적을 필요가 없다		