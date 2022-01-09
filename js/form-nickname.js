// ここで、サーバーに送信してPHPで確認する前に、ブラウザで確認する。
validate_form();
function validate_form() {
    const $input = document.querySelector("#input-nickname");
    const $form = document.querySelector(".validate-form");

    // "input"で、値を入力した時発火             e は thisみたいなもん
    $input.addEventListener("input", function (e) {
        // e.currentTargetでHTML情報 valueつけて、入力した内容
        const $target = e.currentTarget;
        // nextElementSibling で次の要素を取得 (下のエラー文)
        const $err = $target.nextElementSibling;

        $target.classList.remove("is-valid");
        $target.classList.add("is-invalid");

        // inputに問題ない時
        if ($target.checkValidity()) {
            $target.classList.add("is-valid");
            $target.classList.remove("is-invalid");
            $err.innerHTML = "";

        } else {
            // input の属性のやつをチェック
            if ($target.validity.valueMissing) {
                // requireがついていて、inputが空白の時
                $err.innerHTML = "値の入力が必須です";
            } else if ($target.validity.tooShort) {
                // minLengthより小さい時
                $err.innerHTML = $target.minLength + "文字以上で入力せい！ 今は" + $target.value.length + "文字です！";
            } else if ($target.validity.tooLong) {
                // maxLengthより大きい時(そうそうない)
                $err.innerHTML = $target.minLength + "文字以下で入力してください。 今は" + $target.value.length + "文字です！";
            }
        }
        activateSubmitBtn($form);
    });
}

// submit の disable の設定
function activateSubmitBtn($form) {
    const $submitBtn = $form.querySelector('[type="submit"]');

    // form 内の inputが全部OKの時  disabledを外す
    if ($form.checkValidity()) {
        $submitBtn.removeAttribute("disabled");
    } else {
        $submitBtn.setAttribute("disabled", true);
    }
}