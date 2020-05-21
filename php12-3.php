<?php

//定数を宣言
const STONE = 0;
const SCISSORS = 1;
const PAPER = 2;
const HAND_TYPE = [
    STONE => 'グー',
    SCISSORS => 'チョキ',
    PAPER => 'パー'
];

const DRAW = 0;
const LOSE = 1;
const WIN = 2;
const JUDGE = [
    DRAW => 'あいこ',
    LOSE => '負け',
    WIN => '勝ち'
];

const AGAIN = "Y";
const END = "N";

//じゃんけんスタート
all(); // main → all　に変更
function all()
{
    echo "じゃんけんをしましょう！";
    echo PHP_EOL;
    main();
    echo "再戦をする場合は Y を、 しない場合は N を入力してください。";
    echo PHP_EOL;
    $again = stdinAgain();
    if ($again == AGAIN) { // Y をAGAINに変更
        return all();
    }
    exit();
}

function main()
{
    echo "あなたの出す手は？" . STONE . "= \"グー\"," . SCISSORS . " = \"チョキ\"," . PAPER . "= \"パー\"";
    echo PHP_EOL;
    $your_hand = stdin();
    echo "あなたは" . HAND_TYPE[$your_hand] . "を出しました。";
    echo PHP_EOL;
    $pc_hand = getPCHand();
    echo "コンピューターは" . HAND_TYPE[$pc_hand] . "を出しました。";
    echo PHP_EOL;
    $result = resultCheck($your_hand, $pc_hand);
    show($result);
}

function stdin()
{
    $input = trim(fgets(STDIN));
    $validation = checkInput($input);
    if ($validation === false) {
        return stdin();
    }
    return $input;
}

function checkInput($input)
{
    if ($input == "") {
        echo "入力値がありません。0~2の数字を入力してください。
        ";
        return false;
    }
    if (!array_key_exists($input, JUDGE)) { //JUDGEのキーに入力値が存在するか？
        echo "0~2の数字を入力してください。";
        return false;
    }
    if (is_numeric($input) == false) {
        echo "0~2の数字を入力してください。";
        return false;
    }
    return true;
}

function getPCHand()
{
    $pc_num = mt_rand(0, 2);
    return $pc_num;
}

function resultCheck($yours, $pcs)
{
    switch (($yours - $pcs + 3) % 3) {
        case 0:
            return JUDGE[DRAW];
            break;
        case 1:
            return JUDGE[LOSE];
            break;
        case 2:
            return JUDGE[WIN];
            break;
    }
}

function show($result)
{
    echo "結果は" . $result . "でした。";
    echo PHP_EOL;
    if ($result == JUDGE[DRAW]) { //あいこならもう一度勝負
        return main();
    }
}

function stdinAgain()
{
    $input = trim(fgets(STDIN));
    $validation = checkInputAgain($input);
    if ($validation === false) {
        return stdinAgain();
    }
    return $input;
}

function checkInputAgain($input)
{
    if ($input == AGAIN || $input == END) { //Y と N を定数へ変更
        return true;
    }
    echo "Y か N を正しく入力してください。";
    return false;
}
