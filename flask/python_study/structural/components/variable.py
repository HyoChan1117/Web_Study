# 1. 변수 선언
value = 0


# 2. 변수 자료형
# Primitive variable
# integer, float, string, boolean
val_int = 0
val_float = 0.0
val_str = ""
val_boolean = True

# list, dictionary, set, tuple
# Reference variable
refer_list = [1, 2, 3]
refer_dict = {"name": "Alice", "age": 25}
refer_set = {1, 2, 3}
refer_tuple = (10, 20)

# 형 변환
# 묵시적 형변환
x = 10
y = 2.5
z = x + y
print(z, type(z))   # 12.5 <class 'float'>

# 명시적 형변환
a = "123"
b = int(a)
print(b + 1)   # 124

c = 3.7
d = int(c)
print(d)    # 3  : float -> int 변환하면 소수점 버림

# falsy
False        # 불리언 False
None         # None 객체
0            # int
0.0          # float
0j           # complex
''           # 빈 문자열
[]           # 빈 리스트
{}           # 빈 딕셔너리
set()        # 빈 집합
()           # 빈 튜플

# falsy 이 외의 값들은 대부분 Truthy


# 3. 변수 접근 범위 / 생명 주기
# 전역 변수
# 변수가 선언될 때 출생, 프로그램이 종료될 때 소멸
variable_global = 0

# 지역 변수
# 함수 내에서 선언된 변수
# 지역 변수는 함수가 호출될 때 출생, 선언문이 종료될 때 소멸
# 함수 내 선언
def test():
    variable_local = 0

