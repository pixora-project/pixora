document.getElementById('up_comment').addEventListener('input', () => {
    if (document.getElementById('up_comment').value.trim() === "") {
        document.getElementById('postBtn').classList.add('disabled');
    } else {
        document.getElementById('postBtn').classList.remove('disabled');
    }
});