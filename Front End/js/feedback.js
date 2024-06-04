// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
      x.previousElementSibling.className += " w3-theme-d1";
    } else { 
      x.className = x.className.replace("w3-show", "");
      x.previousElementSibling.className = 
      x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
  }
  
  // Used to toggle the menu on smaller screens when clicking on the menu button
  function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else { 
      x.className = x.className.replace(" w3-show", "");
    }
  }

  function post() {
    var text = document.getElementById("postarea").innerText;
    var userName = document.getElementById("username").textContent.trim();
    var url = document.getElementById("profilepic").getAttribute('src');

    var post = `
        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
          <img src="${url}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <span class="w3-right w3-opacity">just now</span>
          <h4>${userName}</h4><br>
          <hr class="w3-clear">
          <p>${text}</p>
          <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
        </div>
      `;

      var postsContainer = document.getElementById('postContainer');
      postsContainer.insertAdjacentHTML('afterbegin', post);
      postsContainer.children[1].after(postsContainer.children[0]);

  }

  var likeCount = 0;

    function likePost(button) {
        likeCount++;
        document.getElementById("likeCounter").innerText = " "+likeCount;
    }