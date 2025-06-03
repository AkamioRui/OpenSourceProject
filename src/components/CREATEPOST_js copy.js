
async function insert_Post(){
    //assign by php
    
    //input
    let post_title = document.querySelector("#title").value;
    let post_contents = document.querySelector("#description").value;
    let postPicture_pictures = document.querySelector("#images").files;
    let forum_id = $forum_id;
    
    
    //create form body
    let formbody = new FormData();
    formbody.append('submit',1);
    formbody.append('forum_id',forum_id);
    formbody.append('post_title',post_title);
    formbody.append('post_contents',post_contents);
    for( let file of postPicture_pictures){
        formbody.append('postPicture_picture[]',file);
    }

    //send request
    let response =  await (await fetch('/module/SQL_on_PHP/CREATEPOST_LISTENER.php',{
        method:"POST",
        body:formbody
    })).text();

    //append new post 
    let doc = new DOMParser().parseFromString(response,'text/html');
    /* temp */console.log(doc.children);
        

      

}