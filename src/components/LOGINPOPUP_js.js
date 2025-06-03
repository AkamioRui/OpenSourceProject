async function query_Login(){
    //$_POST['user_arg'];
    //$_POST['user_password'];
    /* temp */let user_arg = document.querySelector('#arg').value;
    /* temp */let user_password = document.querySelector('#password').value;

    let form = new FormData();
    form.append('query_Login',1);
    form.append('user_arg',user_arg);
    form.append('user_password',user_password);

    let response = await (await fetch('/module/SQL_on_PHP/SIGNUPPOPUP_LISTENER.php',{
        method:'POST',
        body:form
    })).text();

    let doc = new DOMParser().parseFromString(response,'text/html');
    
    HEADER_updateProfilePic(document.querySelector('#header'));
    
};