<?php
const STONE  = 1;
const CISSORS = 2;
const PAPER = 3;

const HAND_TYPE = array(
    STONE => "グー",
    CISSORS => "チョキ",
    PAPER => "パー",
);

const DROW = 0;
const LOSE = 1;
const WIN = 2;

/*もう一度遊ぶ時に指定した定数。　文字入力の際にstring型の "1" になるので定数も "1"にしています。*/
const AGAIN = "1";

function main(){
    $myHand = inputMyHand();
    $comHand = getComHand();
    $result = judge($myHand,$comHand);
    show($result);

    /*もう一度main関数を繰り返す処理を同じmain関数内に持ってきました.*/
     $again = again($result);
    if($again === true){
        return main();
    }
}

function inputMyHand(){
    echo "入力してください";
    $myHand = trim(fgets(STDIN));
    $check = check($myHand);
/*こちらもinputMyHand関数が他の関数内でreturnされていたため移動しました。*/
    if($check === false){
        return inputMyHand();
    }
    return $myHand;
}

function getComHand(){
    $comHand = array_rand(HAND_TYPE);
    return $comHand;
}


function judge($myHand,$comHand){
    echo "自分が".HAND_TYPE[$myHand]."相手が".HAND_TYPE[$comHand].PHP_EOL;
    return ($myHand - $comHand + 3) % 3;
}

/*theck関数の返り値をboolean型に統一しました。*/
function check($myHand){
    if(!$myHand){
        echo "数字が入力されていません".PHP_EOL;
        return false;
    }

    if(!array_key_exists($myHand,(Array)HAND_TYPE)){
        echo "1,2,3のいずれかを入力してください".PHP_EOL;
        return false;
    }
    return true;
}


function show($result){

    if($result === DROW){
        echo "引き分けです";
    }
    if($result === LOSE){
        echo "負けです";
    }
    if($result === WIN){
        echo "勝ちです.".PHP_EOL;

    }
}
/*再戦するために新規で作成した関数です*/
function again($result){
    if($result === DROW){
        echo "再戦します";
        return true;
    }
    if($result === WIN){
        echo "もう一度遊びますか？".PHP_EOL;
        echo "もう一度遊ぶなら１を押してください、終えるならそれ以外を押してください";
        $reMatch = trim(fgets(STDIN));
        if($reMatch === AGAIN){
            echo "もう一度遊びます".PHP_EOL;
            return true;
        }
        return false;
    }
}

main();
