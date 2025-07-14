# 상속 : 자식 클래스가 부모 클래스로부터 멤버(필드, 메서드)를 물려받는 것
# -> 소스코드의 재사용성이 높아지고, 유지보수가 쉬워짐

# 언제 사용할까?
# 서로 독립적인 클래스들 사이에 공통된 기능이나 속성이 존재할 때,
# 공통 부분은 부모 클래스에 정의, 각 클래스별로 특화된 부분은 자식 클래스에서
# 확장하거나 수정하여 사용

# 상속을 하면 할 수 있는 일
# 1. 부모로부터 속성과 기능을 그대로 물려 받음 - 이어받음
class Parents:
    def __init__(self):
        # 인스턴스 변수 생성
        self.birth = 1971
        print("1. 부모로부터 속성과 기능을 그대로 물려 받음")
        print("부모 객체입니다.")
        
    def speak(self):
        print(f"{self.birth}년생입니다.")
        
class Child(Parents):
    def __init__(self):
        self.birth = 1998
        print("자식 객체입니다.")
        
parents = Parents()
parents.speak()

child = Child()
child.speak()

print("-----------------------------------------------------")

# 2. 부모의 기능을 기반으로 새로운 기능 추가 - 확장
class Parents1:
    def __init__(self):
        print("부모 객체입니다.")
        
    def speak(self):
        print("부모 메서드의 기능입니다.")
        
class Child1:
    def __init__(self):
        print("자식 객체입니다.")
        
    def speak(self):
        print("부모에게서 물려받은 자식 고유의 기능입니다.")

# 3. 부모의 기능을 재정의하여 다르게 동작하도록 수정 - 재정의, 오버라이딩
