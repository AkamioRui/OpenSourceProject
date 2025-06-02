function change_profilePic(){
    // $_FILES['user_profilePic']
    // if($_POST['change_profilePic'])
    
    /* temp */let file = document.querySelector('#fileInput').files[0];
    /* temp */let headerProfilePic = document.querySelector('#fileInput').files[0];
    let form = new FormData();
    form.append('change_profilePic',1);
    form.append('user_profilePic',file);

    fetch('/module/SQL_on_PHP/ACCOUNTPOPUP_LISTENER.php',{
        method: "POST",
        body: form
    }).then(Response =>Response.text()).then(str =>{
        let doc = new DOMParser().parseFromString(str,'text/html');

        if(doc.body.style.getPropertyValue('--code') == 'success') console.log('success');
        document.querySelector('#profilePic').src = doc.body.innerHTML;
        
        
        
        
    });


}