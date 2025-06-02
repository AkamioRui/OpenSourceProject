
async function sendPost(){
    //assign by php
    // $forum_id; 

    let post_title = document.querySelector("#title").value;
    let post_contents = document.querySelector("#description").value;
    let postPicture_pictures = document.querySelector("#images").files;
    
    
    //create form body
    let formbody = new FormData();
    formbody.append('submit','submit');
    formbody.append('forum_id',$forum_id);
    /* temp */formbody.append('post_title',post_title);
    /* temp */formbody.append('post_contents',post_contents);
    for( let file of postPicture_pictures){
        formbody.append('postPicture_picture[]',file);
    }

    //send request
    let response =  await (await fetch('/module/SQL_on_PHP/CREATEPOST_LISTENER.php',{
        method:"POST",
        body:formbody
    })).text();
    let msg = await response.text();
        
    
    //process response
    let msgdoc = new DOMParser().parseFromString(msg,'text/html');
    for( let element of msgdoc.children){
        document.body.appendChild(element);
    }
      

}