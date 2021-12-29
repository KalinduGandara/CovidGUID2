function selectAllCheckBoxes() {
    let checkBoxes = document.querySelectorAll('input[type="checkbox"]');
    checkBoxes.forEach(element => {
        if(element.checked === true){
            element.checked = false;
        }
        else element.checked = true;
    });

    let selectAllBox_state = document.getElementById("selectAllBox").checked;
    document.getElementById("selectAllBox").checked = !selectAllBox_state;
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});