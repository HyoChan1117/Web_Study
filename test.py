import os
import re
import graphviz

def extract_dependencies(file_path):
    """PHP 파일에서 include 및 require 관계를 추출"""
    dependencies = []
    include_pattern = re.compile(r'(?:include|require|include_once|require_once)\s*[\'"](.+?)[\'"]')

    with open(file_path, 'r', encoding='utf-8', errors='ignore') as file:
        for line in file:
            match = include_pattern.search(line)
            if match:
                dependencies.append(match.group(1))  # 포함된 파일 이름 추가

    return dependencies

def create_graphviz_graph(directory):
    """폴더 내 PHP 파일의 관계를 Graphviz로 시각화"""
    dot = graphviz.Digraph(format='png', graph_attr={'rankdir': 'LR'})  # 좌->우 방향 그래프

    php_files = {f for f in os.listdir(directory) if f.endswith('.php')}
    
    for php_file in php_files:
        dot.node(php_file, shape="box", style="filled", fillcolor="lightblue")  # 파일을 노드로 추가
        file_path = os.path.join(directory, php_file)
        dependencies = extract_dependencies(file_path)

        for dep in dependencies:
            if dep in php_files:  # 폴더 내 존재하는 PHP 파일만 연결
                dot.edge(php_file, dep)

    output_path = os.path.join(directory, 'php_project_graph')
    dot.render(output_path, view=True)  # 그래프 생성 후 표시
    print(f"📂 그래프가 '{output_path}.png' 로 저장되었습니다!")

# 사용 예시 (여기에 본인 프로젝트 폴더 경로 입력)
project_folder = r"C:\Users\USER\OneDrive - yjc.ac.kr\바탕 화면\학습자료\Web_Study\BOARD_2"
create_graphviz_graph(project_folder)
