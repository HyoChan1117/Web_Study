<?php
// 주민등록번호 유효성을 검사하는 함수
define('MASK', '******');
function validateSSN($ssn) {
    // 입력 형식 검증 (정규 표현식 사용)
    // 주민등록번호는 반드시 '123456-1234567' 형식이어야 함
    if (!preg_match("/^\d{6}-\d{7}$/", $ssn)) {
        return "입력 형식이 잘못되었습니다. 예: 123456-1234567";
    }

    // 앞자리(생년월일)와 뒷자리 분리
    list($front, $back) = explode('-', $ssn);
    
    // 앞자리에서 생년, 월, 일을 추출
    $year = substr($front, 0, 2); // 앞 두 자리: 연도
    $month = substr($front, 2, 2); // 중간 두 자리: 월
    $day = substr($front, 4, 2); // 마지막 두 자리: 일
    
    // 뒷자리의 첫 번째 숫자 추출 (출생연대 판별용)
    $first_digit = substr($back, 0, 1);
    
    // 출생 연대 판별 (1~4만 허용)
    if ($first_digit < '1' || $first_digit > '4') {
        return "입력하신 주민등록번호 {$front}-{$first_digit}" . MASK . "은(는) 유효하지 않습니다.";
    }
    
    // 출생 연도 계산 (출생연대 판별 숫자에 따라 세기 결정)
    $century = ($first_digit == '1' || $first_digit == '2') ? 1900 : 2000;
    $full_year = $century + $year;
    
    // PHP 내장 함수 checkdate()로 날짜 유효성 검사
    if (!checkdate($month, $day, $full_year)) {
        return "입력하신 주민등록번호 {$front}-{$first_digit}" . MASK . "은(는) 유효하지 않습니다.";
    }
    
    // 체크섬 계산을 위한 가중치 배열 (각 자리수마다 곱할 값)
    $weights = [2, 3, 4, 5, 6, 7, 8, 9, 2, 3, 4, 5];
    
    // 주민등록번호의 앞 12자리 숫자 추출
    $digits = str_split($front . substr($back, 0, 6));
    
    // 체크섬 계산
    $sum = 0;
    for ($i = 0; $i < 12; $i++) {
        $sum += $digits[$i] * $weights[$i];
    }
    
    // 체크섬 값 계산 (11로 나눈 나머지를 사용)
    $remainder = $sum % 11;
    $checksum = (11 - $remainder) % 10;
    
    // 마지막 자리(검증 숫자)와 비교하여 유효성 검사
    if ($checksum != substr($back, -1)) {
        return "입력하신 주민등록번호 {$front}-{$first_digit}" . MASK . "은(는) 유효하지 않습니다.";
    }
    
    // 유효한 경우 마스킹된 주민등록번호와 함께 출력
    return "입력하신 주민등록번호 {$front}-{$first_digit}" . MASK . "은(는) 유효합니다.";
}

// 사용자 입력 (예제 주민등록번호)
$ssn = "790608-2552416";

// 유효성 검사 실행 후 결과 출력
$result = validateSSN($ssn);
echo $result;

?>
