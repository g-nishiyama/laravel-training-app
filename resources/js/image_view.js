// 記事新規画面、記事編集画面で画選択時に画像を表示する
$("#inputImage").on("change", function (e) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#viewImage").attr("src", e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});