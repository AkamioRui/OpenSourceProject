async function insert_Forum(){ 
    // $_POST['name'];
    // $_FILES['banner']['tmp_name']);
    // $_FILES['icon']['tmp_name']);
    // $_POST['descriptions']; 
    // $_SESSION['uid'];
    let name = document.querySelector('#name').value;
    let banner = document.querySelector('#banner').files[0];
    let icon = document.querySelector('#icon').files[0];
    let descriptions = document.querySelector('#descriptions').value;

    let form = new FormData();
    form.append('insert_Forum',1);
    form.append('name',name);
    form.append('banner',banner);
    form.append('icon',icon);
    form.append('descriptions',descriptions);
    

    let response = await (await fetch('/module/SQL_on_PHP/CREATEFORUM_LISTENER.php',{
        method:'POST',
        body:form
    })).text();
    let code = new DOMParser().parseFromString(response,'text/html').body.style.getPropertyValue('--code');
    console.log(code);
    


}  