console.log("jojo");

window.addEventListener("load", function (e) {
    let myElem = this.document.querySelector("#example2_wrapper");

    myElem.firstChild.remove();

});

window.addEventListener("load", function (e) {
    let myElem = this.document.querySelector("#example1_wrapper");

    myElem.firstChild.remove();
});
