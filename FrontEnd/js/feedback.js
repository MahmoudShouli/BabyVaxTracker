function initialize() {


  let xhttp = new XMLHttpRequest();


  xhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {



      let objectPosts = JSON.parse(this.responseText);

      let arrayPosts = Object.values(objectPosts);

      // Iterate through each post object
      arrayPosts.forEach(post => {
        // Accessing each property of the post object
        let postID = post.postID;
        let timestamp = post.timestampp;
        let content = post.contentt;
        let username = post.usernamee;
        let photo = post.photo;
        let likes = post.likes;
        let isOwned = post.isOwned;
        let isAdmin = post.isAdmin;
        let isLiked = post.isLiked;
        let isCurAdmin = post.isCurAdmin;


        displayPost(postID,timestamp,content,username,photo,likes,isOwned,isAdmin,isLiked,isCurAdmin);

      });


    }


  };// end of func

  xhttp.open("POST", "../../BackEnd/php/manage_posts.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=init");



}// end of initialize

function publish() {


  let content = document.getElementById('postarea').value;


  let xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);


      let photo = response.photo;
      let userName = response.user_name;
      let isAdmin = response.isAdmin;
      let postID = response.postID;
      let theme = response.theme;



      displayPost(postID,'just now!', content, userName, photo, 0, true,isAdmin,0,isAdmin)

      showCont(theme);

    }


  };// end of func

  xhttp.open("POST", "../../BackEnd/php/manage_posts.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=post&content=" + encodeURIComponent(content));




}// end of post







function like(button, id){


  // Retrieve the text content of the button
  let buttonText = button.textContent.trim(); // Trim to remove any leading/trailing whitespace

  // Split the button text by whitespace
  let buttonTextParts = buttonText.split(/\s+/); // Split by any whitespace

  // Extract the "Like" text (assuming it's the last part)
  let action = buttonTextParts[buttonTextParts.length - 1];



  let xhttp = new XMLHttpRequest();



  xhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);


      let likes = response.likes;


      if(action === 'Like')
        button.innerHTML = "<i class=\"fa fa-thumbs-down\"></i> " + likes + ' Unlike';


      else if (action === 'Unlike')
        button.innerHTML = "<i class=\"fa fa-thumbs-up\"></i>" +" "+likes + ' Like';



    }


  };// end of func

  xhttp.open("POST", "../../BackEnd/php/manage_posts.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=" +action+ "&postID=" + encodeURIComponent(id));


} // end of like


function deleteP(id){


  let xhttp = new XMLHttpRequest();


  xhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {

      document.getElementById(id).remove();

    }


  };// end of func

  xhttp.open("POST", "../../BackEnd/php/manage_posts.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=delete&postID=" + encodeURIComponent(id));



} // end of delete



function displayPost(ID,time,cont,name,phot,like,isOwn,isAdm,isLike, isCurAdmin){



  if (isAdm === true){
    name = name + "&nbsp&nbsp&nbsp&nbsp<span id='admin' style='color:red ;'>(ADMIN)</span>";
  }




  let post = `

           <section id="${ID}" class="w3-container w3-card w3-white w3-round w3-margin"><br>
               <img src="${phot}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="height:60px;width:60px">
               <span class="w3-right w3-opacity">${time}</span>
               <h4  class = "comic-neue-bold" style="text-transform: capitalize">${name}</h4><br>
               <hr class="w3-clear">
               <p style="margin-bottom:30px; margin-top:15px; font-weight:bold; color:black">${cont}</p>
               <button  id="like${ID}" onclick = "like(this, '${ID}');" name="likeBtn" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>0 Like</button>
               <button  id="delete${ID}"  name="deleteBtn"  onclick = " deleteP('${ID}' );" class="w3-button w3-theme-d1 w3-margin-bottom" style="background-color:red; !important; display: none"><i class="fa fa-remove"></i> Delete</button>
           </section>
                 `;



  let postsContainer = document.getElementById('postContainer');
  postsContainer.insertAdjacentHTML('afterbegin', post);
  postsContainer.children[1].after(postsContainer.children[0]);



  if(isLike===1)
    document.getElementById('like'+ID).innerHTML = "<i class=\"fa fa-thumbs-down\"></i>"+ " "+like + " Unlike";
  else
    document.getElementById('like'+ID).innerHTML = "<i class=\"fa fa-thumbs-up\"></i>"+" "+like + " Like";


  if(isOwn===true||isCurAdmin===true)
    document.getElementById('delete'+ID).style.display = "inline";
  else
    document.getElementById('delete'+ID).style.display = "none";



} // end of display



function openFileInput() {
  document.getElementById('profilePicUpload').click();
}

function uploadProfilePic() {
  let fileInput = document.getElementById('profilePicUpload');
  let file = fileInput.files[0];
  if (!file) {
    return; // No file selected
  }

  let formData = new FormData();
  formData.append('profilePicUpload', file); // Ensure 'profilePicUpload' matches the input name in PHP

  let xhr = new XMLHttpRequest();
  xhr.open('POST', '../../BackEnd/php/update_photo.php', true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      //let response = JSON.parse(this.responseText);

      window.location.reload();

      // let photo = response.photo;
      // let name = response.namee;
      // let city = response.city;
      // let email = response.emil;


      // let post = `
      //
      //      <h4 class="w3-center comic-neue-bold">My Profile</h4>
      //      <p class="w3-center">
      //      <img id="profilepic" src='${photo}' class="w3-circle" style="height:150px;width:150px;margin-top:10px" alt="Avatar">
      //      </p>
      //
      //       <hr>
      //
      //       <p style="text-transform: capitalize" id="username"><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>${name}</p>
      //       <p style="text-transform: capitalize"><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>${city} , Palestine</p>
      //       <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i>${email}</p>
      //
      //
      //
      //            `;
      //
      //
      //
      //
      // document.getElementById('uploadForm').style.display='none';
      //
      //
      //
      //
      // let postsContainer = document.getElementById('profile');
      // postsContainer.insertAdjacentHTML('afterbegin', post);
      //postsContainer.children[1].after(postsContainer.children[0]);

    }




  };

  xhr.send(formData);
}





