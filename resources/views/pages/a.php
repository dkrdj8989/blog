<?php
class MethodTest {
    public function __call($name, $arguments)
    {   
        echo "일반 메소드 호출: $name ";
        echo "아규먼트 " . implode(', ', $arguments). "\n";
    } 
    public static function __callStatic($name, $arguments)
    {
        echo "정적 메소드 호출: $name ";
        echo "아규먼트 " . implode(', ', $arguments). "\n";
    }
}
  
// 클래스내 메소드로 호출
$obj = new MethodTest ();
$obj->whereName('name', 'lesstif');
  
// 정적 함수로 호출
MethodTest ::whereName('name', 'lesstif');