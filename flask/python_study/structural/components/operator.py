# 연산자
# 연산자를 보는 3가지 관점
# 1. 연산자의 종류 (기능적으로)
# 2. 연산의 우선 순위
# 3. 이항 연산에서 산술연산을 할 때 자료형 일치 여부를 확인해야 함


# 연산자의 종류
# 1. 산술 연산자
# +, -, *, / (/, //, %)

# 2. 비교 연산자
# ==, !=, >, >=, <, <= -> 6가지
# 결과값 : boolean
# 이항연산
print(1 == 2)  # False 출력
print(3 > 1)   # True 출력

# 3. 논리 연산자
# and, or, not, ... -> 피연산자의 자료형이 무조건 boolean형으로 나와야 함
# 이항연산
# and : 이항연산에서 좌항과 우항이 모두 참일 때 -> A 이면서 B
# or : 이항연산에서 좌항과 우항 중 하나라도 참일 때 -> A 이거나 B
print(True and True)   # True 출력
print(True or False)   # True 출력

# 단항연산
# not : 피연산자의 결과값을 반대로 바꿔주는 것
print(not False)   # True 출력

# 4. 대입 연산자
# = -> 오른쪽 값을 왼쪽 변수에 할당
# name = value -> value 값을 name 변수에 저장
int_value = 1

# 5. 삼항 연산자
msg = "안녕" if int_value == 1 else "hi"
val_list = [val for val in range(1, 11)]


# 연산자 우선 순위
# 우선 순위가 가장 높은 것 : 괄호 / 가장 낮은 것 : 대입 연산자
# 우선 순위를 잘 모를 때는 괄호 사용하기


# 이항 연산에서 산술연산을 할 때 자료형 일치 여부를 확인해야 함
# 자료형이 일치하지 않을 때는 에러가 나는지 혹은 인터프리터가 자동으로 변환해 주는지 보기