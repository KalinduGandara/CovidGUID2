function openForm(delete_id = null) {
    document.getElementById("myForm").style.display = "block";
    if(delete_id !== null)
    {
        document.getElementById("delete_id").value = delete_id;
    }
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}