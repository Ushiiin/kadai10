$("#btn").on("click", function() {
    const myans = document.querySelector("#check").value;
    console.log(myans);
    const correctans = document.querySelector("#answer").value;
    console.log(correctans);
    const result = document.querySelector("#result");
    if (myans == correctans) {
        $("#result").html("正解にゃん")
    } else {
        $("#result").html("不正解にゃん")
    }
})