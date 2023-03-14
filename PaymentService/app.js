// //function validateForm() {
//     var x = document.forms["myForm"]["fname"].value;
//     if (x == "") {
//       alert("Name must be filled out");
//       return false;
//     }
//   }

  // function validateform(){  
  //   var fname=document.myform.name.value;  
  //   var lname=document.myform.name.value;  
      
  //   if (fname==null || fname==""){  
  //     alert("Name can't be blank");  
  //     return false;  
  //   }
  //   else if (lname==null || lname==""){  
  //       alert("Name can't be blank");  
  //       return false;  
  //   }  
    
  //   }

        // On Key Press Function Starts for Disabling Special Characters
      //   function alpha(e) {
      //     var k;
      //     document.all ? k = e.keyCode : k = e.which;
      //     return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
      // }
      
      //         //Validation Function Starts
      //     function validation(){
      
      //         // Fetching Values in Variables
      //     var username = document.getElementById("username").value;
      //     var password = document.getElementById("password").value;
      //     var confirmPass = document.getElementById("confirmPass").value;
      //     var mobile = document.getElementById("mobile").value;
      //     var email = document.getElementById("email").value;
      
      //         // Username Validations
      //     if(username == ""){
      //         document.getElementById("errorUserName").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Username Field is required!";
      //         return false;
      //     }
      //     if((username.length <=2 || username.length >20)){
      //         document.getElementById("errorUserName1").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Username must be between 3 to 20 characters only!";
      //         return false;
      //     }
      //     if(!isNaN(username)){
      //         document.getElementById("errorUserName2").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Numbers / Special Characters are not allowed!";
      //         return false;
      //     }
      
      //         // Password Validations
      //     if(password == ""){
      //         document.getElementById("errorPass").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Please fill the Password Field!";
      //         return false;
      //     }
      //     if(password.length <=4 || (password.length >20)){
      //         document.getElementById("errorPass1").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Password must be between 5 to 20 characters only!";
      //         return false;
      //     }
      
      //         // Confirm Password Validations
      //     if(confirmPass == ""){
      //         document.getElementById("errorConfirmPass").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Please fill the Confirm Password Field!";
      //         return false;
      //     }
      //     if(password!=confirmPass){
      //         document.getElementById("errorConfirmPass1").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Password does not match!";
      //         return false;
      //     }
      
      //         // Mobile Number Validations
      //     if(mobile == ""){
      //         document.getElementById("errorMobile").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Please fill the Mobile Number Field!";
      //         return false;
      //     }
      //     if(isNaN(mobile)){
      //         document.getElementById("errorMobile1").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Invalid Mobile Number!";
      //         return false;
      //     }
      //     if(mobile.length<=11){
      //         document.getElementById("errorMobile2").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Mobile Number must have 11 Digits minimum!";
      //         return false;
      //     }
      
      //         // Email ID Validations
      //     if(email == ""){
      //         document.getElementById("errorEmail").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Please fill the Email Field!";
      //         return false;
      //     }
      //     if(email.indexOf('@') <= 0){
      //         document.getElementById("errorEmail1").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Invalid Position of at the rate (@)!";
      //         return false;
      //     }
      //     if((email.charAt(email.length-4)!='.') && (email.charAt(email.length-3)!='.')){
      //         document.getElementById("errorEmail2").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Invalid Position of dot (.)!";
      //         return false;
      //     }
      //     {    document.getElementById("msg").innerHTML = "<button type='button' class='close' data-dismiss='alert'>&times;</button>Registration Done Successfully!";}
          
      // }


      (function(w, d, u){
	
        "use strict";
        
        let width,
          height,
          xtri,
          ytri,
          vertices,
          triangles,
          triSVG = document.getElementById('triSVG'),
          svgNS = triSVG.namespaceURI, // http://www.w3.org/2000/svg
          grouping = document.getElementById('group');
        
        function createTriangles() {
          let x, y,
            xsize = width * xtri,
            ysize = height * ytri;
          for (let xi = 0; xi <= xsize; xi += width) {
            for (let yi = 0; yi <= ysize; yi += height) {
              let xslice = xi / xtri,
                yslice = yi / ytri;
              if (xi === 0) {
                x = xi;
              } else if (xi === xsize) {
                x = Math.floor(xslice);
              } else {
                x = Math.floor(xslice + (Math.random() * (xslice / 3 + 1) - (xslice / 6)));
              }
              if (yi === 0) {
                y = yi;
              } else if (yi === ysize) {
                y = Math.floor(yslice);
              } else {
                y = Math.floor(yslice + (Math.random() * (yslice / 3 + 1) - (yslice / 6)));
              }
              vertices.push([x, y]);
            }
          }
          
          triangles = Delaunay.triangulate(vertices);
      
          for (var i = 0; i < triangles.length; i += 3) {
            drawTriangle(i);
          }
        }
        
        function drawTriangle(i) {
          var polygon = document.createElementNS(svgNS, 'polygon');
          polygon.setAttribute("points", [
            vertices[triangles[i]][0], vertices[triangles[i]][1],
            vertices[triangles[i + 1]][0], vertices[triangles[i + 1]][1],
            vertices[triangles[i + 2]][0], vertices[triangles[i + 2]][1]
          ]);
          polygon.setAttribute("fill", randomColor());
          
          // var centroid = {
          //   x: (vertices[triangles[i]][0] + vertices[triangles[i + 1]][0] + vertices[triangles[i + 2]][0]) / 3,
          //   y: (vertices[triangles[i]][1] + vertices[triangles[i + 1]][1] + vertices[triangles[i + 2]][1]) / 3
          // };
          
          // var circle = document.createElementNS(svgNS, "circle");
          // circle.setAttribute("cx", centroid.x);
          // circle.setAttribute("cy", centroid.y);
          // circle.setAttribute("r",  1);
          // circle.setAttribute("fill", "#FFF");
          
          grouping.appendChild(polygon);
          // grouping.appendChild(circle);
        }
        
        function randomColor() {
          var r = Math.floor(Math.random() * 100) + 100,
            b = Math.floor(Math.random() * 50) + 200;
          return 'rgb(' + r.toString() + ',0,' + b.toString() + ')';
        }
        
        function onResize() {
          // while (grouping.lastChild) {
          //   grouping.removeChild(grouping.lastChild);
          // }
          // grouping.parentNode.replaceChild(grouping.cloneNode(false), grouping);
          // grouping = document.getElementById('group');
          grouping.innerHTML = ''; // remove all child nodes
          vertices = [];
          width = window.innerWidth;
          height = window.innerHeight;
          triSVG.setAttribute("width",  width);
          triSVG.setAttribute("height", height);
          xtri = Math.ceil(width / 100);
          ytri = Math.ceil(height / 100);
          createTriangles();
        }
        
        onResize();
        
        window.addEventListener('resize', onResize);
        
        function randomPoly() {
          return Math.floor(Math.random() * (triangles.length/3));
        }
        
        function nextPoly() {
          var triSVG = document.querySelectorAll("#triSVG polygon");
          TweenLite.to(triSVG[randomPoly()], .4, {fill: randomColor(), onComplete: nextPoly});
        }
        
        nextPoly();
        
        triSVG.style.opacity = 1;
        
      }(window, document));