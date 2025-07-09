# 함수 (Function)
# def 함수이름(매개변수1, 매개변수2, ...):
#     실행할 코드
def function_name(arg1, arg2):
    arg1 = 1
    arg2 = 2
    
    sum = arg1 + arg2
    
    return sum

# 함수 사용 순서
# 해당 언어에서 오버로딩을 지원하는가 확인 -> 파이썬은 제공 안함
# hoisting : 변수나 함수의 스크립트를 최상단으로 끌어올리는 것 -> 파이썬은 제공 안함
# 1. 함수 정의
# 2. 함수 호출

# Collection unpacking
# 기본 컬렉션 언패킹
x, y, z = (1, 2, 3)
print(x, y, z)

a, b, c = [4, 5, 6]
print(a, b, c)

m, n = "hi"
print(m, n)

# 별표 언패킹
first, *rest = [1, 2, 3, 4]
print(first)   # 1
print(rest)    # [2, 3, 4]

*start, last = [1, 2, 3, 4]
print(start)   # [1, 2, 3]
print(last)    # 4

a, *middle, b = [1, 2, 3, 4, 5]
print(a, middle, b)  # 1 [2, 3, 4] 5

# 함수 호출 시 언패킹
def add(a, b, c):
    return a + b + c

nums = [1, 2, 3]
print(add(*nums))   # 6


def greet(name, age):
    print(f"{name} is {age} years old.")
    
info = {"name": "Kim", "age": 26}
greet(**info)

