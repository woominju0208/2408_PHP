-- DDL :관계형 데이터베이스의 구조를 정의하는데 사용(테이블 만들기)

-- DB 데이터 베이스 생성
-- CREATE DATABASE shop;

-- DB 선택
-- USE shop;

-- DB 삭제
-- DROP DATABASE shop;


-- -------------------------------------
-- 테이블 생성
-- -------------------------------------
CREATE TABLE users (
	id			BIGINT(20)		PRIMARY KEY		AUTO_INCREMENT
	,NAME		VARCHAR(50)		NOT NULL
	,addr		VARCHAR(150)	NOT NULL
	,gender	CHAR(1)			NOT NULL		COMMENT 'M = 남자, F = 여자'
	,tel		VARCHAR(20)		NOT NULL		COMMENT '- 제외 숫자'
	,created_at	TIMESTAMP	NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,updated_at	TIMESTAMP	NOT NULL	DEFAULT CURRENT_TIMESTAMP()
	,deleted_at	TIMESTAMP			
);

CREATE TABLE products (
	id					BIGINT(20)			PRIMARY KEY			AUTO_INCREMENT
	,product_name	VARCHAR(100)		NOT NULL
	,price			BIGINT(20)			NOT NULL
	,created_at		TIMESTAMP			NOT NULL	DEFAULT	CURRENT_TIMESTAMP()
	,updated_at		TIMESTAMP			NOT NULL	DEFAULT	CURRENT_TIMESTAMP()
	,deleted_at 	TIMESTAMP			
);

CREATE TABLE orders (
	id					BIGINT(20)			PRIMARY KEY		AUTO_INCREMENT
	,user_id			BIGINT(20)			NOT NULL
	,order_id		VARCHAR(50)			NOT NULL
	,total_price 	BIGINT(20)			NOT NULL
	,created_at		TIMESTAMP			NOT NULL DEFAULT	CURRENT_TIMESTAMP()
	,updated_at		TIMESTAMP			NOT NULL DEFAULT	CURRENT_TIMESTAMP()
	,deleted_at 	TIMESTAMP			
);


-- 이름  타입  제약조건  코멘트  (서로 tab이나 띄어쓰기 해줘야 한다)

-- CURRENT_TIMESTAMP() : 데이터를 작성한 시간부터 작성
-- NOW() : 데이터 테이블을 만든 시간부터 작성
-- DEFAULT 값에 CURRENT_TIMESTAMP() 을 넣어야 현재 작성한 시간이 들어간다

-- -------------------------------------
-- 테이블 연결(ERD 생성)
-- 비식별:상위테이블 pk,하위테이블 일반 컬럼일때 선택
-- 식별  :상위,하위둘다 pk 일때 선택




-- -------------------
-- 테이블 제거
-- DDL은 제거하면 기록이 없어져서 백업 할 수 없다.(미리 백업)
-- -------------------
-- DROP TABLE orders;
-- DROP TABLE users,products;

-- ---------------------
-- 테이블 비우기(TRUNCATE 테이블);
-- ---------------------
-- TRUNCATE title_emps;


-- ---------------------
-- ALTER : 테이블의 구조를 수정하는 문
-- ALTER 문의 요소가 정말 많음
-- ---------------------
-- FK 추가방법
ALTER TABLE [테이블명]
ADD CONSTRAINT [CONSTRAINT명]
FOREIGN KEY (CONSTRAINT 부여 컬럼명)
REFERENCES 참조테이블명(참조테이블 컬럼명)
[ON DELETE 동작 / ON UPDATE 동작];
-- on delete, on update 둘 중 하나만 쓸수 있다 delete 정도 쓴다
-- 데이터들의 관리는 보통 PHP에서 제어하게 된다
-- 둘중 하나도 안쓰면 기본은 상위 테이블에 연결된 하위 테이블이 있으면 연결된 상위 테이블이 지워지지 않는다(RESTRICT) 
-- CONSTRAINT 제약조건 적는법 : [제약조건_테이블_제약조건 부여컬럼명]

-- FOREIGN 키를 사용할려면 밑에 [ON DELETE 동작 / ON UPDATE 동작]빼고 다 적어야 함

ALTER TABLE orders
ADD CONSTRAINT fk_orders_user_id
FOREIGN KEY (user_id)
REFERENCES users(id)
;

-- ---------------------
-- 컬럼 수정
-- ---------------------
ALTER TABLE users
MODIFY COLUMN addr VARCHAR(100) NOT NULL 
;
-- ---------------------
-- 컬럼 추가
-- 보통 ERD에서 추가하고 컬럼해서 추가 해준다
-- ---------------------
ALTER TABLE users
ADD COLUMN birth DATE NOT NULL
;
UNSIGNED : 부호없음


-- ---------------------
-- 컬럼 제거
-- ---------------------
ALTER TABLE users
DROP COLUMN birth
;


-- pk부호없음 추가
-- 1.참조해있던 PK와FK의 참조를 DROP CONSTRAINT 해서 연결을 끊어준다
-- 2.PK의 컬럼 요소를 수정해준다
-- 3.FK의 컬럼 요소도 PK와 똑같이 수정해준다
-- 4.PK와 FK 의 모든 요소가 같아졌기 때문에 둘이 다시 엮을수 있다.

-- pk 와 fk 가 참조돼 있을때 둘이 풀지않는이상 pk,fk 둘다 컬럼 요소를 바꿀수 없나
-- ALTER문에서 fk(FOREIGN KEY)를 수정(MODIFY)하는 기능은 없다. 

ALTER TABLE orders
DROP CONSTRAINT fk_orders_user_id;

ALTER TABLE users
DROP COLUMN id;

ALTER TABLE users
ADD COLUMN id BIGINT(20) UNSIGNED;

ALTER TABLE users
ADD PRIMARY KEY(id);

ALTER TABLE users
MODIFY BIGINT(20) NOT NULL AUTO_INCREMENT UNSIGNED; 


ALTER TABLE users
MODIFY COLUMN id BIGINT(20) UNSIGNED AUTO_INCREMENT;

ALTER TABLE orders
MODIFY COLUMN user_id BIGINT(20) UNSIGNED NOT NULL;

ALTER TABLE orders
MODIFY COLUMN id BIGINT(20) UNSIGNED AUTO_INCREMENT;

ALTER TABLE products
MODIFY COLUMN id BIGINT(20) UNSIGNED AUTO_INCREMENT;


-- AUTO_INCREMENT는 PK에만 들어가는 요소이다.
-- BIGINT 와 unsigned 까지 하나의 데이터 타입 이기때문에 같이 붙여서 써줘야 한다.

-- 처음부터 컬럼에 필요한 요소(ex> UNSIGNED, AUTO_INCREMENT 등)를 전부 넣어주자 나중에 고생함
-- 새로운 테이블을 추가하는경우는 있지만 테이블안 컬럼을 추가,제가,수정 하는 경우는 잘 없다
-- 테이블 데이터가 안나올때 상단의 선택된 베이스 연결 해제 하고 다시 킨다