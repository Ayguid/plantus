  var post_input= document.getElementById('post_input');
  var post_button= document.getElementById('post_button');
  var submitPost= document.getElementById('submitPost');



  post_button.onclick = function(){
    if (post_input.style.display === "block") {
      post_input.style.display = "none";
    } else {
      post_input.style.display = "block";
    }
  }

//rompe el required  
  submitPost.onclick = function(){
      post_input.style.display = "none";
  }
