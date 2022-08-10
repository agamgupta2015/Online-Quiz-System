var inputText = function () {
    var a = document.querySelector("#Question").value;
    document.querySelector("#Quiz").innerText = a;
    document.querySelector("#Question").value = "";
    document.querySelector("#Question").focus();
};

