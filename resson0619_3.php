<?php 
// じゃんけんの手
const STONE = 0;
const SCISSORS = 1;
const PAPER = 2;
const HAND_TYPE = array(
    STONE => 'グー',
    SCISSORS => 'チョキ',
    PAPER => 'パー'
);

// 勝敗
const DRAW  = 0;
const LOSE = 1;
const WIN = 2;
const RESULT_LIST = array(
    DRAW => 'あいこです',
    LOSE => 'あなたの負けです',
    WIN => 'あなたの勝ちです'
);

// YESNO
const YES  = 'y';
const NO = 'n';
const ANSWER = array(
    YES => '続ける',
    NO => '続けない',
);

// 回数
const FIRST = 0;
$count = FIRST;

game($count);

function game($count){
    if($count === FIRST) {
        echo "じゃんけん、、（グー:0、チョキ:1、パー:2）\n";
    } else {
        echo "あいこで、、（グー:0、チョキ:1、パー:2）\n";
    }
    $myhand = inputMyHand();
    $comhand = getComHand();
    $result = judge($myhand, $comhand);
    show($result);
    if ($result === RESULT_LIST[DRAW]){
        $count ++;
        return game($count);
    }
    echo "ゲームを続けますか？（続ける:y、続けない:n）\n";
    if (continueGame() === YES){
        $count = FIRST;
        return game($count);
    };
    echo "ゲーム終了";
    exit();
}

function inputMyHand(){
    $myhand = trim(fgets(STDIN));
    if(!check($myhand)){
        return inputMyHand();
    }
    return $myhand;
}

function getComHand(){
    $comhand =  array_rand(HAND_TYPE);
    return $comhand;
}

function check($myhand){
    if($myhand === NULL || $myhand === ''){
        echo "グー(0)、チョキ(1)、パー(2)の数字を入力してください。\n";
        return false;
    }
    if(!is_numeric($myhand)){
        echo "数字を入力してください。\n";
        return false;
    }
    if(!array_key_exists($myhand, HAND_TYPE)){
        echo "0から2の数字を入力してください。\n";
        return false;
    }
    return true;
}

function judge($myhand, $comhand){
    echo "あなた[" . HAND_TYPE[$myhand] . "]\n";
    echo "プログラム[" . HAND_TYPE[$comhand] . "]\n";
    $battle = ($myhand -  $comhand + 3) % 3;
    if($battle === DRAW){
        $result = RESULT_LIST[DRAW];
    } else if($battle === LOSE) {
        $result = RESULT_LIST[LOSE];
    } else if($battle === WIN) {
        $result = RESULT_LIST[WIN];
    } 
    return $result;
  }

function show($result){
    echo $result . "\n" ;
}

function continueGame(){
  $answer = trim(fgets(STDIN));
  if(!checkAns($answer)){
      return continueGame();
  }
  if($answer === YES){
      return YES;
  }
  return NO;
}

function checkAns($answer){
    if(!array_key_exists($answer, ANSWER)){
        echo "yかnを入力してください。\n";
        return false;
    }
    return true;
}

?>


