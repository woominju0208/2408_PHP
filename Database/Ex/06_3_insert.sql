-- INSERT 문 : 신규 데이터를 저장

-- 기본구조
-- INSERT INTO 테이블명 (컬럼1, 컬럼2 ...)
-- VALUES (값1, 값2 ...);

INSERT INTO employees(
	name
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
	,'2024-09-02'
	,NULL
	,NULL
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,null
)
;
-- pk > 자동으로 한칸씩 늘어난다 ( ERD에 노란 열쇠부분)
-- hire_at,fire_at 은 날짜만 created_at,updated_at,deleted_at 은 시간 까지
-- insert 컬럼명 순서와 values 순서를 똑같이 적어야한다.


-- select insert (insert 컬럼과 select 컬럼 순서를 무조건 똑같이!!!!!)
-- where 절 필수!!!!!
-- select insert 는 이미 있는 데이터를 똑같이 다시 넣는것
INSERT INTO employees(
	name
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
)
select 
	name
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
FROM employees
WHERE emp_id IN (1,2)
;


-- 자신의 직급 정보 삽입
INSERT INTO title_emps (
	emp_id
	,title_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100003
	,'T001'
	,'2024-09-02'
	,null
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,null
);
-- SELECT * FROM title_emps WHERE emp_id=100003;   데이터가 들어갔는지 select문으로 확인

-- 자신의 급여 정보 삽입
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
	100003
	,26000000
	,'2024-09-02'
	,null
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,NULL
);

-- 자신의 소속부서 삽입
INSERT INTO  department_emps (
	emp_id
	,dept_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100003
	,'D002'
	,'2024-09-02'
	,null
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,null
);
-- employees 에서 저장된 emp-id 가 100003 이기 때문에 (100001,100002이 없기 때문)
-- 100001,100002는 오류가 난다. 그래서 직급정보,급여정보,소속부서등은 emp_id 를 100003 적어줘야함


-- 이런식으로 ,넣고 여러개 데이터 추가 가능
INSERT INTO employees(
	name
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
)
VALUES ('우민주','2000-02-08','F','2024-09-02',NULL,NULL,'2024-09-02 00:00:00','2024-09-02 00:00:00',NULL)
		,('강아지','2000-02-08','F','2024-09-02',NULL,NULL,'2024-09-02 00:00:00','2024-09-02 00:00:00',null)
		,('고양이','2000-02-08','F','2024-09-02',NULL,NULL,'2024-09-02 00:00:00','2024-09-02 00:00:00',null)
;