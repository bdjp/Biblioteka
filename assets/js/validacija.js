
function proveriPodatke() {
    let status = true;
    document.querySelector('#error').classList.add('d-none');
    document.querySelector('#error').innerHTML = '';

    const title = document.querySelector('#title').value;
    if(!title.match(/.*[^\s]{3,}.*/)) {
        document.querySelector('#error').innerHTML += "Naslov mora sadrzati najmanje 3 vidljiva karaktera...<br>";
        document.querySelector('#error').classList.remove('d-none') ;
        status = false;
    }

    const description = document.querySelector('#description').value;
    if(!description.match(/.*[^\s]{10,}.*/)) {
        document.querySelector('#error').innerHTML += "Opis mora sadrzati najmanje 10 vidljiva karaktera";
        document.querySelector('#error').classList.remove('d-none') ;
        status = false;
    }

    return status;
}