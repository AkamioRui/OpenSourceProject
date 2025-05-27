function showsize(){
    let filesize = 0;
    for(let file of document.querySelector('.filebox').files){
        filesize += file.size;
    }
    document.querySelector('.counter').innerHTML = "size: "+filesize/1000000+"Mb";
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
