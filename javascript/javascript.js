
//single post button hide/displat function

function comments_function() {
    var button = document.getElementById("comments_div");
    if (button.style.display === "none") {
      button.style.display = "block";
      document.getElementById("comment_button").innerHTML="Hide comments";
    } else {
      button.style.display = "none";
      document.getElementById("comment_button").innerHTML="Show comments";
    }
  } 

