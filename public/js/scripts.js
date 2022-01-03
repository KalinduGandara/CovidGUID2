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
