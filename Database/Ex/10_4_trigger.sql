-- 트리거 생성
-- 특정 레코드 삭제(컬럼x)

DELIMITER $$

CREATE TRIGGER del_emp
BEFORE DELETE
	ON employees
FOR EACH ROW
BEGIN 
	DELETE FROM department_emps WHERE emp_id = OLD.emp_id;
	DELETE FROM department_managers WHERE emp_id = OLD.emp_id;
	DELETE FROM salaries WHERE emp_id = OLD.emp_id;
	DELETE FROM title_emps WHERE emp_id = OLD.emp_id;
END $$ 

DELIMITER ;

-- fk로 인해 지워지지 않던게 trigger문을 사용해 지울수 있어 졌다 
-- 선택된 테이블에서 조건을 적어 사라지게 한다 (ex > name = '홍길동')
DELETE FROM employees WHERE emp_id = 2;


-- 트리거 조회
SHOW TRIGGERS;del_empdel_emp
	
