function verifyEdition() {
    const username = document.getElementById('username');
    const useremail = document.getElementById('useremail');
    const userbio = document.getElementById('userbio');
    const usergender = document.getElementById('usergender');
    const userlocation = document.getElementById('userlocation');
    const userdname = document.getElementById('userdname');
    const userbirth = document.getElementById('userbirth');
    const userphone = document.getElementById('userphone');

    let namereg = /^[a-z0-9]{10,}$/;
    let emailreg = /^[a-zA-Z0-9]+@(gmail\.com|yahoo\.com|hotmail\.com|[a-zA-Z]\.(ma|org|com))$/;
    let dnamereg = /^[A-Za-z]$/;
    let phonereg = /^\+[1-9]\d{7,14}$/;

    const errname = document.getElementById('err_username');
    const erremail = document.getElementById('err_useremail');
    const errphone = document.getElementById('err_userphone');
    const errdname = document.getElementById('err_dname');

    let ok = true;
    if (!namereg.test(username)) {
        ok = !ok;
        errname.textContent = "* invalide username";
    }

    if (!emailreg.test(useremail)) {
        ok = !ok;
        erremail.textContent = "* Invalide email";
    }

    if (!dnamereg.test(userdname)) {
        ok = !ok;
        errdname.textContent = "* Invalide display name";
    }

    if (!phonereg.test(userphone)) {
        ok = !ok;
        errphone.textContent = "* Invalide phone";
    }

    if(ok){
        document.getElementById('editProfileForm').submit();
    }
}