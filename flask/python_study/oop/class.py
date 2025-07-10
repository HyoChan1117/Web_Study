# 클래스 : 객체를 생성하기 위한 설계도 (붕어빵틀)
# 객체 : 클래스로부터 만든 제품 (붕어빵)
# 하나의 클래스로부터 여러 개의 객체로 만들 수 있음

# 속성 : 클래스 안의 변수
# 메서드 : 클래스 안의 함수
# 생성자 : 객체를 만들 때 실행되는 함수
# 인스턴스 : 메모리에 살아있는 객체

# 클래스 정의
# class 클래스이름:
#   def 메서드 이름(self):  -> self : 메서드의 첫 번째 매개변수로 꼭 들어가야 함
#       명령 블록
class Monster:
    # 클래스 변수
    live = "육지"
    
    # 생성자
    # def __init__(self, name1, name2, ...):
    # 생성자 생성시 첫 번째 매개변수는 꼭 self(객체 자기 자신)
    # 두 번째부터는 보통 속성 값이 들어감
    def __init__(self, name):  
        self.name = name  # 인스턴스 변수
        
    # 인스턴스 메서드
    def say(self):
        print(f"나는 {self.name}")
        
    # 클래스 메서드
    @classmethod
    def sentance(cls):
        print(f"너는 어디에서 왔니?")
        
# 객체 = 클래스이름()  -> 객체 생성 방법
# 객체.메서드() -> 메서드 호출 방법
shark = Monster("상어")
shark.say()

fish = Monster("물고기")
fish.say()

Monster.sentance()
print(Monster.live)