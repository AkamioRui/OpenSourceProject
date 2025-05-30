<?php
    session_start();
    $_SESSION['uid'] = 2;
    $_GET['forum_id'] = 1;

?>

<!DOCTYPE html>
<html>

<body>
    <button onclick="getpage()">get page</button><br>

    
    <script type="text/javascript">
        getpage();
        async function getpage(){
            let forum_id = <?=$_GET['forum_id']?>;

            //form body
            let formbody = new FormData();
            formbody.append('forum_id',forum_id);

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
             
        }
    </script>


 
    
</body>

</html>

