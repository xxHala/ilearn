
// user Bar
function userIn()
 {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
                              return this.responseText;
                    }
    };
    xmlhttp.open("GET","php/userInfo.php?do=getbar",true);
    xmlhttp.send();
  }



function getData(n)
 {
var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

              document.getElementById("allpost").innerHTML +=this.responseText;
                    }
    };
    xmlhttp.open("GET","php/question.php?do=Q"+n,true);
    xmlhttp.send();
  }

// function to load a new post when click on viewmore
//should load more from the database " this could "use for both job and QuestionS!
//@todo: sals and Aya:DDD
var n=1;
function newpost()
{
        checkUser();
    var loader=document.getElementById("viewmore");
	loader.className="loader";
	loader.innerHTML="";

	// load new post after 3 sec
	setTimeout(function(){ 
        
        getData(n++);
        
		loader.className="viewmore";
		loader.innerHTML="View More";
        },5000);
        
        
		
}

function checkUser()
{
var data = new FormData();
  data.append("do", 'Enable');

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
  xhr.onload = function() {document.getElementById("openQ").innerHTML =this.responseText; };
    
  xhr.send(data);

}



// function to post a new post
function mypost()
{

  var data = new FormData();
  data.append("do", 'New');
  data.append('QuestionTxt', document.getElementById("mypara").value.replace(/\s/g, "\u00a0"));
  data.append('CodeTxt'    , document.getElementById("mypara2").value.replace(/\s/g, "\u00a0"));
  data.append('TagsTxt'    , document.getElementById("tags").value.replace(/\s/g, "\u00a0")); 
  //data.append('photo'      , document.getElementById("tags").value.replace(/\s/g, "\u00a0"));
/* 
alert(document.getElementById("mypara2").value.replace(/\s/g, "\u00a0"));
alert(document.getElementById("mypara").value.replace(/\s/g, "\u00a0"))
alert(document.getElementById("tags").value.replace(/\s/g, "\u00a0"))*/

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
  xhr.onload = function() {
          if (this.responseText != 0)
                  {   
                          alert(this.responseText);
                  }
          else
                  {
                  alert ("you must login first ..");
                  location.href = "http://i-learn.atwebpages.com/login-singup.html"; 
                  }
  };
    
  xhr.send(data);
       
}




/*======== Like increase =========*/

function increase(likerec,dislikerec,thumbsuprec,thumbsdownrec)
{
	var idname1=likerec;
	var idname2=dislikerec;
	var thumbsup=thumbsuprec;
	var thumbsdown=thumbsdownrec;
	var like=document.getElementById(idname1);
	like.innerHTML=parseInt(like.innerHTML)+1;
	var up=document.getElementById(thumbsup);
	up.style.color= "#009688";
	up.style.pointerEvents="none";
	var down=document.getElementById(thumbsdown)
	if(down.style.color=="rgb(0, 150, 136)")
	{
		var dislike=document.getElementById(idname2);
                x=parseInt(dislike.innerHTML)-1;
		dislike.innerHTML=x;
                updateDLikes(idname2,parseInt(dislike.innerHTML));
	}
	down.style.color="black";
	down.style.pointerEvents="all";
        
        updateLikes(idname1 ,parseInt(like.innerHTML));
}

function updateLikes(id,x)
{
 id = id.substring(4);

var data = new FormData();
  data.append('do', 'L');
  data.append('id', id);
  data.append('num', x);
 

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
   
  xhr.send(data);
}


/*============== Like decrease ================*/
function decrease(likerec,dislikerec,thumbsuprec,thumbsdownrec)
{
	var idname1=likerec;
	var idname2=dislikerec;
	var thumbsup=thumbsuprec;
	var thumbsdown=thumbsdownrec;
	var dislike=document.getElementById(idname2);
	dislike.innerHTML=parseInt(dislike.innerHTML)+1;
	var down=document.getElementById(thumbsdown);
	down.style.color= "#009688";
	down.style.pointerEvents="none";
	var up=document.getElementById(thumbsup);
	if(up.style.color=="rgb(0, 150, 136)")
	{
		var like=document.getElementById(idname1);
		like.innerHTML=parseInt(like.innerHTML)-1;
                updateLikes(idname1 ,parseInt(like.innerHTML));
                
	}
	up.style.color="black";
	up.style.pointerEvents="all";
        updateDLikes(idname2,parseInt(dislike.innerHTML));
}

function updateDLikes(id,x)
{
 id = id.substring(7);
 //alert(id);

var data = new FormData();
  data.append('do', 'D');
  data.append('id', id);
  data.append('num', x);
 

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
   
  xhr.send(data);
  
}





/*======== Like increase (Answers)=========*/

function increaseA(likerec,dislikerec,thumbsuprec,thumbsdownrec)
{
	var idname1=likerec;
	var idname2=dislikerec;
	var thumbsup=thumbsuprec;
	var thumbsdown=thumbsdownrec;
	var like=document.getElementById(idname1);
	like.innerHTML=parseInt(like.innerHTML)+1;
	var up=document.getElementById(thumbsup);
	up.style.color= "#009688";
	up.style.pointerEvents="none";
	var down=document.getElementById(thumbsdown)
	if(down.style.color=="rgb(0, 150, 136)")
	{
		var dislike=document.getElementById(idname2);
                x=parseInt(dislike.innerHTML)-1;
		dislike.innerHTML=x;
                updateDLikes(idname2,parseInt(dislike.innerHTML));
	}
	down.style.color="black";
	down.style.pointerEvents="all";
        
        updateLikes(idname1 ,parseInt(like.innerHTML));
}

function updateLikes(id,x)
{
 id = id.substring(5);

var data = new FormData();
  data.append('do', 'LA');
  data.append('id', id);
  data.append('num', x);
 

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
   
  xhr.send(data);
}


/*============== Like decrease  (Answers)================*/
function decreaseA(likerec,dislikerec,thumbsuprec,thumbsdownrec)
{
	var idname1=likerec;
	var idname2=dislikerec;
	var thumbsup=thumbsuprec;
	var thumbsdown=thumbsdownrec;
	var dislike=document.getElementById(idname2);
	dislike.innerHTML=parseInt(dislike.innerHTML)+1;
	var down=document.getElementById(thumbsdown);
	down.style.color= "#009688";
	down.style.pointerEvents="none";
	var up=document.getElementById(thumbsup);
	if(up.style.color=="rgb(0, 150, 136)")
	{
		var like=document.getElementById(idname1);
		like.innerHTML=parseInt(like.innerHTML)-1;
                updateLikes(idname1 ,parseInt(like.innerHTML));
                
	}
	up.style.color="black";
	up.style.pointerEvents="all";
        updateDLikes(idname2,parseInt(dislike.innerHTML));
}

function updateDLikes(id,x)
{
 id = id.substring(8);
 //alert(id);

var data = new FormData();
  data.append('do', 'DA');
  data.append('id', id);
  data.append('num', x);
 

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
   
  xhr.send(data);
  
}


// load view image to be posted
 var loadFile = function(event) {
	    var output = document.getElementById('load2');
	    output.src = URL.createObjectURL(event.target.files[0]);
            
            alert("src");
	  };

// changing imagebutton color on hover
 function onbuttoncolor()
 {
 	var on=document.getElementById("imgbttn");
 	on.style.backgroundColor = "#009688";
 	on.style.color="white";
 }

// chaging imagebutton color on hover out
 function outbuttoncolor()
 {
 	var out=document.getElementById("imgbttn");
 	out.style.backgroundColor = "white";
 	out.style.color="black";
 }
//////////////////////////////////////////





 
                
                function x(id){
if(document.getElementById("code"+id).style.display != "none")
document.getElementById("code"+id).style.display = "none";
else
document.getElementById("code"+id).style.display = "block";
}  
                
                function xComment(id){
if(document.getElementById("comment"+id).style.display != "none")
document.getElementById("comment"+id).style.display = "none";
else
document.getElementById("comment"+id).style.display = "block";
}

// function to post a new answer
function answer(id)
{

  var data = new FormData();
  data.append("do", 'A');
  data.append("Qid", id);
  data.append('text', document.getElementById("commentText"+id).value.replace(/\s/g, "\u00a0"));
 

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
  xhr.onload = function() {
           if (this.responseText != 0)
                          alert(this.responseText);
           else
                  {
                  alert ("you must login first ..");
                  location.href = "http://i-learn.atwebpages.com/login-singup.html"; 
                  }
  
  };
    
  xhr.send(data);        
}



/*======== Like increase (Answers)=========*/

function increaseA(likerec,dislikerec,thumbsuprec,thumbsdownrec)
{
	var idname1=likerec;
	var idname2=dislikerec;
	var thumbsup=thumbsuprec;
	var thumbsdown=thumbsdownrec;
	var like=document.getElementById(idname1);
	like.innerHTML=parseInt(like.innerHTML)+1;
	var up=document.getElementById(thumbsup);
	up.style.color= "#009688";
	up.style.pointerEvents="none";
	var down=document.getElementById(thumbsdown)
	if(down.style.color=="rgb(0, 150, 136)")
	{
		var dislike=document.getElementById(idname2);
                x=parseInt(dislike.innerHTML)-1;
		dislike.innerHTML=x;
                updateDLikesA(idname2,parseInt(dislike.innerHTML));
	}
	down.style.color="black";
	down.style.pointerEvents="all";
        
        updateLikesA(idname1 ,parseInt(like.innerHTML));
}

function updateLikesA(id,x)
{
 id = id.substring(5);


var data = new FormData();
  data.append('do', 'AL');
  data.append('id', id);
  data.append('num', x);
 

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
   
  xhr.send(data);
}


/*============== Like decrease  (Answers)================*/
function decreaseA(likerec,dislikerec,thumbsuprec,thumbsdownrec)
{
	var idname1=likerec;
	var idname2=dislikerec;
	var thumbsup=thumbsuprec;
	var thumbsdown=thumbsdownrec;
	var dislike=document.getElementById(idname2);
	dislike.innerHTML=parseInt(dislike.innerHTML)+1;
	var down=document.getElementById(thumbsdown);
	down.style.color= "#009688";
	down.style.pointerEvents="none";
	var up=document.getElementById(thumbsup);
	if(up.style.color=="rgb(0, 150, 136)")
	{
		var like=document.getElementById(idname1);
		like.innerHTML=parseInt(like.innerHTML)-1;
                updateLikesA(idname1 ,parseInt(like.innerHTML));
                
	}
	up.style.color="black";
	up.style.pointerEvents="all";
        updateDLikesA(idname2,parseInt(dislike.innerHTML));
}

function updateDLikesA(id,x)
{
 id = id.substring(8);
 //alert(id);

var data = new FormData();
  data.append('do', 'AD');
  data.append('id', id);
  data.append('num', x);
 

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/question.php");
   
  xhr.send(data);
  
}