function showFilesize(){
    let filesize = 0;
    for(let file of document.querySelector('.filebox').files){
        filesize += file.size;
    }
    document.querySelector('.counter').innerHTML = "size: "+filesize/1000000+"Mb";
}

function HEADER_getProfilePic(){
    let form = new FormData();
    form.append('user_profilePic',1);
    
    fetch("/module/SQL_on_PHP/HEADER.php",{
        method:"POST",
        body:form
    }).then(Response => Response.text()).then((src)=>{
        /* temp */document.querySelector('.testimg').src = src;
    });
}

async function getpage(){
    //all script tab must be a direct children of body
    
    //form body
    let formbody = new FormData();
    formbody.append('forum_id',1);

    //send request 
    let response = await fetch('/module/SQL_on_PHP/CREATEPOST.php',{
        method:'POST',
        body: formbody
    });
    let msg = await response.text();

    //process request
    let parser = new DOMParser();
    let msgdoc = parser.parseFromString(msg,'text/html');
    
    let element;
    let myscript;
    while( element = msgdoc.body.children[0] ){
        if(element.tagName == 'SCRIPT'){
            myscript = document.createElement('script');
            try{
                myscript.appendChild(document.createTextNode(element.text));
            }catch(e){
                myscript.text = element.text;
            }
            document.body.appendChild(myscript);
            element.remove();
        } else {
            document.body.appendChild(element);
        }
    }

    //
    while( element = msgdoc.getElementsByTagName('SCRIPT')[0] ){
        myscript = document.createElement('script');
        try{
            myscript.appendChild(document.createTextNode(element.text));
        }catch(e){
            myscript.text = element.text;
        }
        document.appendChild(myscript);
        element.remove();
    }
    
     
}

async function postData(){

    //----------------------create form------------------------------//
    const form = new FormData();

    form.append('data',document.querySelector('form>.textbox').value);
    
    let filesize = 0;
    for(let file of document.querySelector('form>.filebox').files){
        form.append('myimg[]',file);
        filesize += file.size;
        console.log(filesize);
    }
    
    for(let pair of form.entries()){
        console.log(pair);
    }


    //------------------fetch----------------------------------//
    fetch('http://localhost:3000/module/SQL_on_PHP/test.php',{
        method:"POST",
        body: form
    }).then(
        response => response.text()
    ).then((str)=>{
        
        let doc = new DOMParser().parseFromString(str,'text/html');
        while(doc.body.children.length>0){
            document.body.appendChild(doc.body.children[0]);
        }

        let node = document.createElement('p');
        node.innerHTML = 'done';
        document.body.appendChild(node);

    })
    
}
