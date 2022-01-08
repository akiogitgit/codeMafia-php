// ここで、サーバーに送信してPHPで確認する前に、ブラウザで確認する。

init();
function init() {
    const $input = document.querySelector("#validate-target");
    const $input_ok = document.querySelector("#check-ok");
    const $input_no = document.querySelector("#check-no");

    // "input"で、値を入力した時発火             e は thisみたいなもん
    $input.addEventListener("input", function (e) {
        // e.currentTargetでHTML情報
        // valueつけて、入力した内容
        const $target = e.currentTarget;
        // console.log($target.validity);


        $target.classList.add("border-red-500");
        $target.classList.add("focus:border-red-500");
        $input_no.classList.remove("hidden");

        // inputに問題ない
        if ($target.checkValidity()) {
            $target.classList.remove("border-red-500");
            $target.classList.remove("focus:border-red-500");
            $input_no.classList.add("hidden");
            $input_ok.classList.remove("hidden");

        } else {
            // input の属性のやつをチェック
            if ($target.validity.valueMissing) {
                // requireがついていて、inputが空白の時
                console.log("なんかいれんか");
            } else if ($target.validity.tooShort) {
                // minLengthより小さい時
                console.log($target.minLength + "文字以上で入力せい！ 今は" + $target.value.length + "文字じゃい！");
            } else if ($target.validity.tooLong) {
                // maxLengthより大きい時(そうそうない)
                console.log($target.maxLength + "文字以下で入力せい！ 今は" + $target.value.length + "文字じゃい！");
            } else if ($target.validity.patternMismatch) {
                // pattern に合わない時
                console.log("半角英数字で入力せい１");
            }

            $input_no.classList.remove("hidden");
            $input_ok.classList.add("hidden");
        }



    });
}
function color() {
    this.style.color = "red";
}