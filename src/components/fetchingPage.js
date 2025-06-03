//homepage
    // fetch_accountPopup();
    function redirect_ForumPage(forum_id){
        window.location.href = '/src/php/FORUMPAGE.php?'+'forum_id='+forum_id;
    }
    // redirect_PostPage();// each post in html must have post_id
    function fetch_CreateForum(){
        
    }
//forumpage
    // redirect_Back();
    // fetch_accountPopup();
    // redirect_PostPage();//in js, must know this postId
    // fetch_CreatePost();
//postpage
    // redirect_Back();//must know the previous fullpage
    // fetch_accountPopup();
    // fetch_CreateComment();
//accountPopup
    // redirect_Back();//must know the previous fullpage
    // fetch_LoginPopup(); 
//loginPopup
    // redirect_Back();//must know the previous fullpage
    // fetch_SignupPopup();         
//signupPopup
    // redirect_Back();//must know the previous fullpage
    // fetch_LoginPopup();
//createForumPopup
    // redirect_Back();//must know the previous fullpage
//createPostPopup
    // redirect_Back();//must know the previous fullpage
//createCommentPopup
    // redirect_Back();      

        

function HEADER_updateProfilePic(element){
    let form = new FormData();
    form.append('user_profilePic',1);
    
    fetch("/module/SQL_on_PHP/GENERAL_LISTENER.php",{
        method:"POST",
        body:form
    }).then(Response => Response.text()).then((src)=>{
        element.src = src;
    });
}



function placeChildinto(destination,body){
    let element;
    let myscript;
    while( element = body.children[0] ){
        if(element.tagName == 'SCRIPT'){
            myscript = document.createElement('script');
            try{
                myscript.appendChild(document.createTextNode(element.text));
            }catch(e){
                myscript.text = element.text;
            }
            destination.appendChild(myscript);
            element.remove();
        } else {
            destination.appendChild(element);
        }
    }
        
    //if script is outside body, change the input to the whole doc, and 
    // while( element = msgdoc.getElementsByTagName('SCRIPT')[0] ){
    //     myscript = document.createElement('script');
    //     try{
    //         myscript.appendChild(document.createTextNode(element.text));
    //     }catch(e){
    //         myscript.text = element.text;
    //     }
    //     document.appendChild(myscript);
    //     element.remove();
    // }
}

// async function postData(){

//     //----------------------create form------------------------------//
//     const form = new FormData();

//     form.append('data',document.querySelector('form>.textbox').value);
    
//     let filesize = 0;
//     for(let file of document.querySelector('form>.filebox').files){
//         form.append('myimg[]',file);
//         filesize += file.size;
//         console.log(filesize);
//     }
    
//     for(let pair of form.entries()){
//         console.log(pair);
//     }


//     //------------------fetch----------------------------------//
//     fetch('http://localhost:3000/module/SQL_on_PHP/test.php',{
//         method:"POST",
//         body: form
//     }).then(
//         response => response.text()
//     ).then((str)=>{
        
//         let doc = new DOMParser().parseFromString(str,'text/html');
//         while(doc.body.children.length>0){
//             document.body.appendChild(doc.body.children[0]);
//         }

//         let node = document.createElement('p');
//         node.innerHTML = 'done';
//         document.body.appendChild(node);

//     })
    
// }

// function showFilesize(){
//     let filesize = 0;
//     for(let file of document.querySelector('.filebox').files){
//         filesize += file.size;
//     }
//     document.querySelector('.counter').innerHTML = "size: "+filesize/1000000+"Mb";
// }