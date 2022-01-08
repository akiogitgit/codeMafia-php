function poll_chart() {
    // const $chart = document.querySelector("#chart");
    const $chart = document.querySelector("canvas");
    const ctx = $chart.getContext("2d"); // canvas の情報を取得
    const likes = $chart.dataset.likes;
    const dislikes = $chart.dataset.dislikes;

    // chart 取れない時
    if (!$chart) {
        data = {
            labels: ['まだ投票がありません。'],
            datasets: [{
                data: [1],
                backgroundColor: [
                    "#9ca3af",
                ]
            }]
        }
        // return;
    }

    let data;

    if (likes == 0 && dislikes == 0) {
        data = {
            labels: ['まだ投票がありません。'],
            datasets: [{
                data: [1],
                backgroundColor: [
                    "#9ca3af",
                ]
            }]
        }
    } else {
        data = {
            labels: ['賛成', '反対'],
            datasets: [{
                // label: 'アンケート',
                data: [likes, dislikes],
                backgroundColor: [
                    "#34d399",
                    "#f87171",
                ]
            }]
        }
    }

    // chart.js の chart を作成
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            legend: {
                position: "bottom",
                labels: {
                    fontSize: 18
                }
            }
        }
    });

}
poll_chart();