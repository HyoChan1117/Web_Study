# 클래스 선언
class Animal:
    # 생성자 생성
    def __init__(self, name):
        self.name = name
    
    # 메소드 생성
    def say(self):
        print(f"나는 {self.name}입니다.")
    
# 객체 생성
dog = Animal("강아지")
cat = Animal("고양이")

# 객체의 메소드 호출
dog.say()
cat.say()