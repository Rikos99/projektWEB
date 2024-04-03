function toggleDropdown() {
    $(".dropdown-content1").toggleClass("show");
}

$(document).mouseup(function(e) {
    var container = $(".dropdown1");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $(".dropdown-content1").removeClass("show");
    }
});

$(document).mouseup(function(e) {
    var container = $(".dropdown1");
    if (!container.is(e.target) && container.has(e.target).length === 0 && !$(e.target).hasClass('dropbtn1')) {
        $(".dropdown-content1").removeClass("show");
    }
});