<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>TeeSpace</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/main_css/login.css">
   </head>
   <body>
      <div class="container">
         <header style="font-size: 35px">Registration Form</header>
         <form action="{{ route('register.store') }}" method="POST" >
          @csrf
            <div class="input-field">
               <input type="text"  name="name" placeholder="@error('name'){{ $message }}@enderror"> 
               <label>Full Name</label>
            </div>
            <div class="input-field">
               <input type="text"  name="email" placeholder="@error('email'){{ $message }}@enderror"> 
               <label>Email</label>
            </div>
            <div class="input-field">
               <input class="pswrd" type="password"  name="password" placeholder="@error('password'){{ $message }}@enderror">
               <span class="show">SHOW</span>
               <label>Password</label>
            </div>
            <div class="input-field">
               <input class="pswrd" type="password"  name="password_confirmation" placeholder="@error('password_confirmation'){{ $message }}@enderror">
               <label>Password Confirm</label>
            </div>
            <div class="button">
               <div class="inner"></div>
               <button type="submit">Submit</button>
            </div>
         </form>
         <div class="auth">
            Or Register with
         </div>
         <div class="links">
            <div class="facebook">
               <i class="fab fa-facebook-square"><span>Facebook</span></i>
            </div>
            <div class="google">
               <i class="fab fa-google-plus-square"><span>Google</span></i>
            </div>
         </div>
         <div class="signup">
            Already a member? <a href="{{ route('customer.login') }}">login now</a>
         </div>
      </div>
      <script>
         var input = document.querySelector('.pswrd');
         var show = document.querySelector('.show');
         show.addEventListener('click', active);
         function active(){
           if(input.type === "password"){
             input.type = "text";
             show.style.color = "#1DA1F2";
             show.textContent = "HIDE";
           }else{
             input.type = "password";
             show.textContent = "SHOW";
             show.style.color = "#111";
           }
         }
      </script>
   </body>
</html>